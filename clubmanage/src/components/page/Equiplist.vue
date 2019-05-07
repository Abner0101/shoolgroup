<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-text"></i> 申请表</el-breadcrumb-item>
                <el-breadcrumb-item>申请列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="申请日期"
                  width="150">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.update_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="申请内容"
                  width="250">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-text"></i>
                    <span style="margin-left: 10px">{{ scope.row.e_content }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="申请类型"
                  width="100">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="warning">{{ scope.row.e_nature}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="使用时段"
                  width="220">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-remind"></i>
                    <span style="margin-left: 10px">{{ scope.row.e_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="申请人"
                  width="120">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-profile"></i>
                    <span style="margin-left: 10px">{{ scope.row.e_man }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="原因/用途"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-favor"></i>
                    <span style="margin-left: 10px">{{ scope.row.e_purpose }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="审核进度"
                  width="130">
                  <template slot-scope="scope">
                    <el-tag size="medium" type="success" v-if="scope.row.ispass==1">审核通过</el-tag>
                    <el-tag size="medium" type="info" v-if="scope.row.ispass==2">审核中</el-tag>
                    <el-tag size="medium" type="danger" v-if="scope.row.ispass==0">审核不通过</el-tag>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleEdit(scope.$index, scope.row)">重新申请</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除申请</el-button>
                  </template>
                </el-table-column>
            </el-table>

             <el-dialog title="重新申请" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="申请类型" prop="e_nature">
                        <el-select v-model="ruleForm.e_nature" placeholder="请选择申请性质">
                          <el-option label="课室" value="课室"></el-option>
                          <el-option label="器材" value="器材"></el-option>
                          <el-option label="设备" value="设备"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="申请内容" prop="e_content">
                        <el-input v-model="ruleForm.e_content"></el-input>
                    </el-form-item>

                    <el-form-item label="使用时段" prop="e_time">
                        <el-date-picker
                          v-model="ruleForm.e_time"
                          type="daterange"
                          range-separator="至"
                          start-placeholder="开始日期"
                          end-placeholder="结束日期"
                          format="yyyy-MM-dd"
                          value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </el-form-item>

                    <el-form-item label="原因/用途" prop="e_purpose">
                        <el-input v-model="ruleForm.e_purpose" type="textarea"></el-input>
                    </el-form-item>

                    <el-form-item label="申请社团" prop="e_clubname">
                        <el-input v-model="ruleForm.e_clubname" :disabled="true"></el-input>
                    </el-form-item>

                    <el-form-item label="申请人" prop="e_man">
                        <el-input v-model="ruleForm.e_man" :disabled="true"></el-input>
                    </el-form-item>

                    <el-form-item label="备注" prop="beizhu">
                        <el-input v-model="ruleForm.beizhu" type="textarea"></el-input>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="submitForm('ruleForm')">立即申请</el-button>
                        <el-button @click="resetForm('ruleForm')">取消</el-button>
                    </el-form-item>
                </el-form>
            </el-dialog>

        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name: 'Equilist',
        data() {
            return {
                tableData: [],
                dialogFormVisible:false,
                ruleForm: {
                    e_content:'',
                    e_time:'',
                    e_man:localStorage.getItem('m_name'),
                    e_clubId:localStorage.getItem('departId'),
                    e_clubname:'',
                    e_nature:'',
                    e_purpose:'',
                    beizhu:''
                },
                rules: {
                  e_content: [
                    { required: true, message: '请输入申请内容', trigger: 'blur' },
                    { min: 4, max: 40, message: '长度在 4 到 40 个字符', trigger: 'blur' }
                  ],
                  e_nature: [
                    { required: true, message: '请选择申请类型', trigger: 'change' }
                  ],
                  e_purpose: [
                    { required: true, message: '请填写申请用途', trigger: 'blur' }
                  ],
                  e_time: [
                    { required: true, message: '请选择使用时段', trigger: 'change' }
                  ],
                },
            }
        },
        methods:{
            handleEdit(index, row) {
                this.ruleForm=row;
                this.dialogFormVisible=true;
            },
            handleDelete(index, row) {
                this.$confirm('此操作将取消该申请, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'delEquip',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("申请取消成功",'success'); 
                            this.getEquipMes();
                        }else if(ret.code == 101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(ret.error,'error'); 
                        }
                    });
                    
                }).catch(() => {
                  this.$message({
                    type: 'info',
                    message: '已取消删除'
                  });          
                });
            },
            resetForm(formName) {
                this.dialogFormVisible=false;
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                  if (valid) {
                    this.$axios
                    .post('http://www.clubs.org/index.php/' + 'editEquip',this.ruleForm)
                    .then((res)=>{
                        let ret=res.data;
                        if(ret.code==200){
                            this.dialogFormVisible=false;
                            this.common.toastMsg('申请修改成功','success');
                            this.getEquipMes();
                        }else if(ret.code==101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(ret.error,'error');
                        }
                    });
                  } else {
                    console.log('error submit!!');
                    return false;
                  }
                });
            },
            getEquipMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllEquip')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp = [];
                        ret.data.forEach((val)=>{
                            if(val.e_clubId == localStorage.getItem('departId')){
                                val.update_time=this.common.toDate(val.update_time);
                                temp.push(val);
                            }
                        });
                        this.tableData=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                  console.log(this.tableData);
                });
            },
        },
        mounted(){
            this.getEquipMes();
        },
        mixins:[http],

    }
</script>

<style scoped>
    
</style>
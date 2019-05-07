<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-text"></i> 申请管理</el-breadcrumb-item>
                <el-breadcrumb-item>申请列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="申请社团"
                  width="150">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-group"></i>
                    <span style="margin-left: 10px">{{ scope.row.e_clubname }}</span>
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
                      @click="handleMore(scope.$index, scope.row)">申请详情</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除申请</el-button>
                  </template>
                </el-table-column>
            </el-table>

            <el-dialog title="申请详情" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="申请类型：" >
                        {{ruleForm.e_nature}}
                    </el-form-item>

                    <el-form-item label="申请内容：" >
                        {{ruleForm.e_content}}
                    </el-form-item>

                    <el-form-item label="使用时段：" >
                        {{ruleForm.e_time}}
                    </el-form-item>
                    
                    <el-form-item label="原因/用途：">
                        {{ruleForm.e_purpose}}
                    </el-form-item>

                    <el-form-item label="申请社团：">
                        {{ruleForm.e_clubname}}
                    </el-form-item>

                    <el-form-item label="申请人：" >
                        {{ruleForm.e_man}}
                    </el-form-item>
                        
                    <el-form-item label="备注：">
                        {{ruleForm.beizhu}}
                    </el-form-item>

                </el-form>
            </el-dialog>
        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name:'Equiplist',
        data() {
            return {
                tableData: [],
                dialogFormVisible:false,
                ruleForm: {
                    e_content:'',
                    e_time:'',
                    e_man:'',
                    e_clubId:'',
                    e_clubname:'',
                    e_nature:'',
                    e_purpose:'',
                    beizhu:''
                },
            }
        },
        methods:{
            getEquipMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllEquip')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            val.update_time=this.common.toDate(val.update_time);
                            temp.push(val);
                        });
                        this.tableData=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            handleMore(index, row){
                this.dialogFormVisible=true;
                this.ruleForm=row;
            },
            handleDelete(index, row) {
                this.$confirm('此操作将取消该申请表, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'M_delEquip',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("申请表删除成功",'success'); 
                            this.getEquipMes();
                        }else if(ret.code ==101){
                            this.handleError();
                        }
                        else{
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
        },
        mounted(){
            this.getEquipMes();
        },
        mixins:[http],
    }
</script>

<style scoped>
    
</style>


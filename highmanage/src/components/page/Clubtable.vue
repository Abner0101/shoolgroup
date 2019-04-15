<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-group"></i> 社团管理</el-breadcrumb-item>
                <el-breadcrumb-item>社团列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>   
        <div class="container">
            <el-table :data="tableData" style="width: 100%">  
                <el-table-column
                  label="社团名称"
                  width="180">
                  <template slot-scope="scope">
                    <el-popover trigger="hover" placement="top">
                      <p>简介: {{ scope.row.c_introduce }}</p>
                      <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">{{ scope.row.c_name }}</el-tag>
                      </div>
                    </el-popover>
                  </template>
                </el-table-column>

                <el-table-column
                  label="创始人"
                  width="180">
                  <template slot-scope="scope">
                    <el-popover trigger="hover" placement="top">
                      <p>姓名: {{ scope.row.c_createrId.m_name}}</p>
                      <p>学号: {{ scope.row.c_createrId.m_number }}</p>
                      <p>性别: {{ scope.row.c_createrId.m_sex }}</p>
                      <p>手机: {{ scope.row.c_createrId.m_phone }}</p>
                      <p>届时: {{ scope.row.c_createrId.m_grade }}</p>
                      <p>班级: {{ scope.row.c_createrId.m_class }}</p>
                      <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">{{ scope.row.c_createrId.m_name }}</el-tag>
                      </div>
                    </el-popover>
                  </template>
                </el-table-column>

                <el-table-column
                  label="社团性质"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-tag"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_nature }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="现任会长"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-profile"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_boss }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="主管单位"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-home"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_manage }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="创建日期"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_createdate }}</span>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                  </template>
                </el-table-column>
            </el-table>

            <el-dialog title="编辑社团" :visible.sync="dialogFormVisible">
                <el-form :model="Askmess" class="colstyle" ref="Askmess"> 
                    <el-col :span="11" >
                        <el-form-item label="申请人：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_name" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11" >
                        <el-form-item label="性别：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_sex" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="学号：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_number" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="手机号码：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_phone" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="届时：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_grade" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="班级：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_createrId.m_class" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="社团名称：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_name" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <el-form-item label="社团性质：" :label-width="formLabelWidth">
                          <el-input v-model="Askmess.c_nature" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-form-item label="主管单位：" :label-width="formLabelWidth">
                        <el-input v-model="Askmess.c_manage" autocomplete="off" style="width:620px;"></el-input>
                    </el-form-item>


                    <el-form-item label="现任会长：" :label-width="formLabelWidth">
                        <el-input v-model="Askmess.c_boss" autocomplete="off" style="width:620px;"></el-input>
                    </el-form-item>

                    <el-form-item label="社团简介：" :label-width="formLabelWidth">
                        <el-input type="textarea" v-model="Askmess.c_introduce" style="width:620px;"></el-input>
                    </el-form-item>
                    <el-form-item label="备注：" :label-width="formLabelWidth">
                        <el-input type="textarea" v-model="Askmess.beizhu" style="width:620px;"></el-input>
                    </el-form-item>

                    <el-form-item :label-width="formLabelWidth">
                        <el-button type="primary" @click="submitForm('Askmess')">确定</el-button>
                        <el-button @click="resetForm('Askmess')">取消</el-button>
                    </el-form-item>
                </el-form>      
            </el-dialog>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                dialogFormVisible:false,
                formLabelWidth: '100px',
                Askmess:{
                    c_name:'',
                    c_boss:'',
                    c_createrId:{
                        m_name:'',
                        m_sex:'',
                        m_phone:'',
                        m_number:'',
                        m_grade:'',
                        m_class:''
                    },
                    c_manage:'',
                    c_nature:'',
                    c_introduce:'',
                    c_biezhu:'',
                    c_boss:'',
                    create_time:'',
                },
            }
        },
        mounted(){
            this.getAllclub();
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$axios
                        .post('http://www.clubs.org/index.php/' + 'M_editClub',this.Askmess)
                        .then((res)=>{
                            let ret = res.data;
                            if(ret.code == 200){
                                this.common.toastMsg("编辑成功",'success');
                                this.dialogFormVisible=false;
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
            resetForm(formName) {
                this.dialogFormVisible=false;
            },
            handleEdit(index, row) {
                this.dialogFormVisible=true;
                this.Askmess=row;
                // console.log(index, row);
            },
            handleDelete(index, row) {
                this.$confirm('此操作将永久删除该社团, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'M_delClub',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("社团解散成功",'success'); 
                            this.getAllclub();
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
                console.log(index, row);
            },
            getAllclub(){
                let temp =[];
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getAllClub')
                .then((res)=>{
                    let respose=res.data;
                    if(respose.code == 200){
                        // let temp1 =[];
                        // let temp2 =[];
                        // let temp3 =[];
                        respose.data.forEach((val)=>{
                            val.c_createdate=this.common.toDate(val.create_time);//时间戳转为字符串
                            this.$axios
                            .get('http://www.clubs.org/index.php/' + 'getMember',{params:{id:val.c_createrId}})
                            .then((res)=>{
                                let ret=res.data;
                                if(ret.code == 200){
                                    val.c_createrId=ret.data
                                }else{
                                   this.common.toastMsg(ret.error,'error'); 
                                }
                            });//获取申请人信息
                            if(val.ispass==1){
                                temp.push(val);
                            }
                            
                        });

                    }else{
                        this.common.toastMsg(respose.error,'error');
                    }
                });
                this.tableData=temp;
                console.log(this.tableData);
            }

        }
    }
</script>

<style scoped>
    
</style>
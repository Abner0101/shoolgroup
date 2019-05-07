<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-profile"></i> 权限管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-row>
                <el-button type="primary" @click="showAdd()">添加管理员+</el-button>
            </el-row>
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="管理员"
                  width="150">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-profile"></i>
                    <span style="margin-left: 10px">{{ scope.row.username }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="注册时间"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.create_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="是否授权"
                  width="180">
                  <template slot-scope="scope">
                    <el-button type="info" icon="el-icon-arrow-right" round v-if="scope.row.status==0" @click="ToShow(scope.row)">
                    否
                    </el-button>
                    <el-button type="success" icon="el-icon-check" round v-if="scope.row.status==1" :disabled="scope.row.id==userId" @click="ToShow(scope.row)">
                    是
                    </el-button>
                  </template>
                </el-table-column>


                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleEdit(scope.$index, scope.row)">修改密码</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)"
                      :disabled="scope.row.id==userId">删除</el-button>
                  </template>
                </el-table-column>
            </el-table>

            <el-dialog title="添加管理员" :visible.sync="dialogFormVisible">
                <el-form :model="addForm" ref="addForm" :rules="addrules" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="账号：" prop="username">
                        <el-input v-model="addForm.username" placeholder="请输入账号(昵称/姓名)"></el-input>
                    </el-form-item>

                    <el-form-item label="密码：" prop="password">
                        <el-input v-model="addForm.password" placeholder="请输入密码"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="addSubmit('addForm')">立即创建</el-button>
                        <el-button @click="noSubmit()">取消</el-button>
                    </el-form-item>

                </el-form>
            </el-dialog>
            
            <el-dialog title="修改密码" :visible.sync="editFormVisible">
                <el-form :model="editForm" ref="editForm" :rules="editrules" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="账号：" prop="username">
                        <el-input v-model="editForm.username" placeholder="请输入账号(昵称/姓名)" :disabled="true"></el-input>
                    </el-form-item>

                    <el-form-item label="新密码：" prop="Newpassword">
                        <el-input v-model="editForm.Newpassword" placeholder="请输入新密码" type="password"></el-input>
                    </el-form-item>

                    <el-form-item label="确认密码：" prop="Compassword">
                        <el-input v-model="editForm.Compassword" placeholder="请再输入密码" type="password"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="editSubmit('editForm')">保存</el-button>
                        <el-button @click="noSubmitEdit()">取消</el-button>
                    </el-form-item>

                </el-form>
            </el-dialog>

        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name:'Manager',
        data(){
            return{
                tableData: [],
                dialogFormVisible:false,
                editFormVisible:false,
                userId:localStorage.getItem('id'),
                addForm:{
                    username:'',
                    password:''
                },
                addrules: {
                    username: [
                      { required: true, message: '请输入账号', trigger: 'blur' }
                    ],
                    password: [
                      { required: true, message: '请输入密码', trigger: 'blur' }
                    ],
                },
                // Newpassword:'',
                // Compassword:'',
                editForm: {
                    id:'',
                    username:'',
                    Newpassword:'',
                    Compassword:'',

                },
                editrules: {
                    Newpassword: [
                      { required: true, message: '请输入新密码', trigger: 'blur' }
                    ],
                    Compassword: [
                      { required: true, message: '请再次输入新密码', trigger: 'blur' }
                    ],
                },
                // Addpassword:'',
                
            }
        },
        methods:{
            getManagerMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllManager')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            val.create_time=this.common.toDate(val.create_time);
                            temp.push(val);
                        });
                        this.tableData=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            handleEdit(index,row){
                this.editFormVisible=true;
                this.editForm.username=row.username;
                this.editForm.id=row.id;
                console.log(this.editForm);
            },
            handleDelete(index, row) {
                this.$confirm('此操作将删除该管理员, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'delManager',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("删除成功",'success'); 
                            this.getManagerMes();
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
            ToShow(row){
                // console.log(row);
                if(row.status==0){
                  var params={
                      id:row.id,
                      status:1
                  };
                }else{
                  var params={
                      id:row.id,
                      status:0
                  };
                }
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'editManager',params)
                .then((res)=>{
                    let ret=res.data;
                    console.log(ret);
                    if(ret.code==200){ 
                        //清空列表重新加载
                        if(row.status == 0){
                          this.getManagerMes();
                          this.common.toastMsg("已授权！",'success');
                        }else{
                          this.getManagerMes();
                          this.common.toastMsg("已取消授权！",'normal');
                        }
                        
                    }
                    else if(ret.code == 101){
                        this.handleError();
                    }
                    else{
                        this.common.toastMsg(ret.error,'warning');
                    }
                });
            },
            editSubmit(formName){
                
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        if(this.editForm.Compassword == this.editForm.Newpassword){
                            let params={
                                id:this.editForm.id,
                                password:this.editForm.Compassword
                            };
                            this.$axios
                            .post('http://www.clubs.org/index.php/' + 'editManager',params)
                            .then((res)=>{
                                let ret=res.data;
                                console.log(ret);
                                if(ret.code==200){ 
                                    this.getManagerMes();
                                    this.editFormVisible=false;
                                    this.common.toastMsg("修改成功！",'success');   
                                }
                                else if(ret.code == 101){
                                    this.handleError();
                                }
                                else{
                                    this.common.toastMsg(ret.error,'warning');
                                }
                            });
                        }else{
                            this.common.toastMsg("两次密码输入不一致！",'warning');
                        } 
                    }else{
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            addSubmit(formName){
                this.$refs[formName].validate((valid) => {
                  if (valid) {
                    this.$axios
                    .post('http://www.clubs.org/index.php/' + 'addManager',this.addForm)
                    .then((res)=>{
                        let ret=res.data;
                        if(ret.code==200){
                            this.common.toastMsg('添加成功','success');
                            this.dialogFormVisible=false;
                            this.getManagerMes();
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

            showAdd(){
                this.dialogFormVisible=true;
            },
            noSubmit(){
                this.dialogFormVisible=false;
            },
            noSubmitEdit(){
                this.editFormVisible=false;
            }


        },
        mounted(){
            this.getManagerMes();
        },
        mixins:[http],
    }
</script>

<style scoped>
    .demo-ruleForm{
        width: 400px;
        margin-left: 30%;
    }
    /* .demo-add{
        width: 1000px;
    } */
</style>

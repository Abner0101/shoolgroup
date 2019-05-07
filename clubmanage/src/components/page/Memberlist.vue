<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-friend"></i> 会员管理</el-breadcrumb-item>
                <el-breadcrumb-item>会员列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="入团时间"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.t_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="成员姓名"
                  width="180">
                  <template slot-scope="scope">
                        <el-tag size="medium">{{ scope.row.t_name}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="成员角色"
                  width="180">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="success">{{ scope.row.role}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleMore(scope.$index, scope.row)">成员信息</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除成员</el-button>
                  </template>
                </el-table-column>
            </el-table>
        </div>

        <el-dialog title="会员信息" :visible.sync="dialogFormVisible">
            <el-form :model="ruleForm" ref="ruleForm" label-width="120px" class="demo-ruleForm">

                <el-form-item label="会员姓名：" prop="a_theme">
                    {{ruleForm.t_name}}
                </el-form-item>

                <el-form-item label="头像：" >
                    <img :src="imgsrc" class="avator-img">
                </el-form-item>

                <el-form-item label="性别：" >
                    {{ruleForm.memberId.m_sex}}
                </el-form-item>

                <el-form-item label="学号：" >
                    {{ruleForm.memberId.m_number}}
                </el-form-item>

                <el-form-item label="手机号码：" >
                    {{ruleForm.memberId.m_phone}}
                </el-form-item>

                <el-form-item label="年级：" >
                    {{ruleForm.memberId.m_grade}}
                </el-form-item>

                <el-form-item label="班级：" >
                    {{ruleForm.memberId.m_class}}
                </el-form-item>

                <el-form-item label="角色：" >
                    {{ruleForm.role}}
                </el-form-item>
                
                <el-form-item label="校园经历：" >
                    {{ruleForm.experience}}
                </el-form-item>
                    
                <el-form-item label="备注：">
                    {{ruleForm.beizhu}}
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name: 'Memberlist',
        data(){
            return{
                tableData: [],
                ruleForm: {
                      t_name:'',
                      t_time:'',
                      experience:'',
                      role:'',
                      memberId:'',
                      clubid:''
                },
                dialogFormVisible: false,
                imgUrl:'http://www.clubs.org',
                imgsrc:'',
            }
        },
        methods:{
            getAllTable(){
                this.$axios.get('http://www.clubs.org/index.php/getAllTable')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        ret.data.forEach((val)=>{
                            if(val.clubId==localStorage.getItem('departId') && val.station==1 
                                && val.role=="普通会员"){
                                this.$axios.get('http://www.clubs.org/index.php/getMember',{params:{id:val.memberId}})
                                .then((memberres)=>{
                                    let memberret=memberres.data;
                                    if(memberret.code == 200){
                                        val.memberId=memberret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                this.tableData.push(val);
                            }
                        });
                        console.log(this.tableData);
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            handleMore(index, row){
                this.dialogFormVisible=true;
                this.imgsrc=this.imgUrl+row.memberId.m_img;
                this.ruleForm=row;
            },
            handleDelete(index, row) {
                this.$confirm('此操作将移除该会员, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'C_delTable',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("操作成功",'success');
                            this.tableData=[]; 
                            this.getAllTable();
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
            this.getAllTable();
        },
        mixins:[http],
    }
</script>

<style scoped>
   .avator-img{
    width: 100px;
    height: 100px;
   } 
</style>
<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-message"></i> 评论</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                  label="评论内容"
                  width="250">
                  <template slot-scope="scope">
                    <i class="el-icon-lx-message"></i>
                    <span style="margin-left: 10px">{{ scope.row.content }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="评论时间"
                  width="250">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.c_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleMore(scope.$index, scope.row)">评论详情</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除评论</el-button>
                  </template>
                </el-table-column>
            </el-table>

             <el-dialog title="评论详情" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                    
                    <el-form-item label="评论内容：">
                        {{ruleForm.content}}
                    </el-form-item>

                    <el-form-item label="评论时间：">
                        {{ruleForm.c_time}}
                    </el-form-item>

                    <el-form-item label="评论人：" >
                        {{ruleForm.memberId}}
                    </el-form-item>

                    <el-form-item label="活动主题：">
                        {{ruleForm.actionId}}
                    </el-form-item>

                </el-form>
             </el-dialog>

        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        data(){
            return{
                tableData:[],
                dialogFormVisible:false,
                ruleForm: {
                    content:'',
                    actionId:'',
                    memberId:'',
                    c_time:''
                },
            }
        },
        methods:{
            getCommentMes(){
                let a_id=this.$route.query.id;
                this.$axios.get('http://www.clubs.org/index.php/getAllComment')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            if(val.actionId==a_id){
                                // val.create_time=this.common.toDateTime(val.create_time);
                                temp.push(val);
                            }    
                        });
                        this.tableData=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                // .then(()=>{
                //     console.log(this.tableData);
                // })
            },
            handleDelete(index,row){
                this.$confirm('此操作将取消该评论, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'M_delComment',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("删除成功",'success'); 
                            this.getCommentMes();
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
            handleMore(index,row){
                this.dialogFormVisible=true;
                this.$axios.get('http://www.clubs.org/index.php/getComment',{params:{id:row.id}})
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        this.$axios.get('http://www.clubs.org/index.php/getMember',{params:{id:ret.data.memberId}})
                        .then((memres)=>{
                            let memret=memres.data;
                            if(memret.code == 200){
                                ret.data.memberId=memret.data.m_name;
                            }
                        });
                        this.$axios.get('http://www.clubs.org/index.php/getAction',{params:{id:ret.data.actionId}})
                        .then((actres)=>{
                            let actret=actres.data;
                            if(actret.code == 200){
                                ret.data.actionId=actret.data.a_theme;
                            }
                        });
                        this.ruleForm=ret.data;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    console.log(this.ruleForm);
                })
            },
        },
        mounted(){
            this.getCommentMes();
        },
        mixins:[http],
    }
</script>
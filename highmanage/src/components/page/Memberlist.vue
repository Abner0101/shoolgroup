<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-friend"></i> 会员管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <el-table :data="tempList" style="width: 100%">
                <el-table-column
                  label="会员姓名"
                  width="180">
                  <template slot-scope="scope">
                        <el-tag size="medium">{{ scope.row.m_name}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="会员学号"
                  width="180">
                  <template slot-scope="scope">
                    <span style="margin-left: 10px">{{ scope.row.m_number }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="性别"
                  width="180">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="success">{{ scope.row.m_sex}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="专业班级"
                  width="180">
                  <template slot-scope="scope">
                    <span style="margin-left: 10px">{{ scope.row.m_class }}</span>
                  </template>
                </el-table-column>

                <el-table-column label="操作">
                  <template slot-scope="scope">
                    <el-button
                      size="mini"
                      @click="handleMore(scope.$index, scope.row)">会员信息</el-button>
                    <el-button
                      size="mini"
                      type="danger"
                      @click="handleDelete(scope.$index, scope.row)">删除会员</el-button>
                  </template>
                </el-table-column>
            </el-table>
            <div class="page-syl">
                <el-pagination
                      background
                      @current-change="handleCurrentChange" 
                      :current-page="currentPage"
                      :page-size="pageSize"
                      layout="prev, pager, next, ->,total"
                      :total="total"
                      >
                </el-pagination>
            </div>

            <el-dialog title="会员信息" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="120px" class="demo-ruleForm">

                    <el-form-item label="头像：" >
                        <img :src="imgsrc" class="avator-img">
                    </el-form-item>

                    <el-form-item label="姓名：" >
                        {{ruleForm.m_name}}
                    </el-form-item>

                    <el-form-item label="性别：" >
                        {{ruleForm.m_sex}}
                    </el-form-item>

                    <el-form-item label="学号：" >
                        {{ruleForm.m_number}}
                    </el-form-item>

                    <el-form-item label="手机号码：" >
                        {{ruleForm.m_phone}}
                    </el-form-item>

                    <el-form-item label="年级：" >
                        {{ruleForm.m_grade}}
                    </el-form-item>

                    <el-form-item label="班级：" >
                        {{ruleForm.m_class}}
                    </el-form-item>

                    <el-form-item label="角色：" >
                        {{ruleForm.role}}
                    </el-form-item>
                    
                </el-form>
            </el-dialog>

        </div>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name:'Memberlist',
        data(){
            return{
                tableData:[],
                dialogFormVisible:false,
                ruleForm:{

                },
                imgUrl:'http://www.clubs.org',
                imgsrc:'',
                //分页
                total:0,
                currentPage:1,
                pageSize:11,
                tempList:[],
            }
        },
        methods:{
            getMemberMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllMember')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        // let temp =[];
                        // ret.data.forEach((val)=>{
                        //     val.create_time=this.common.toDate(val.create_time);
                        //     temp.push(val);
                        // });
                        this.tableData=ret.data;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    console.log(this.tableData);
                    this.total=this.tableData.length;
                    this.currentChangePage(this.tableData,1);
                });
            },
            handleCurrentChange(currentPage) {//页码切换
                this.currentPage = currentPage
                this.currentChangePage(this.tableData,currentPage)  
            },
            currentChangePage(list,currentPage) { 
              let from = (currentPage - 1) * this.pageSize;
              let to = currentPage * this.pageSize;
              this.tempList = [];
              for (; from < to; from++) {
                if (list[from]) {
                  this.tempList.push(list[from]);
                }
              }
            },
            handleMore(index, row){
                this.dialogFormVisible=true;
                this.imgsrc=this.imgUrl+row.m_img;
                this.ruleForm=row;
            },
            handleDelete(index, row) {
                this.$confirm('此操作将移除该会员, 是否继续?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.$axios
                    .get('http://www.clubs.org/index.php/' + 'M_delMember',{params:{id:row.id}})
                    .then((res)=>{
                        let ret =res.data;
                        if(ret.code == 200){
                            this.common.toastMsg("删除成功",'success');
                            this.tableData=[]; 
                            this.getMemberMes();
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
            this.getMemberMes();
        },
        mixins:[http],
    }
</script>

<style scoped>
    .page-syl{
        margin-top: 20px;
    }
    .avator-img{
        width: 100px;
        height: 100px;
    } 
</style>
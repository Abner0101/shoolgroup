<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-profile"></i> 权限管理</el-breadcrumb-item>
                <!-- <el-breadcrumb-item>会员列表</el-breadcrumb-item> -->
            </el-breadcrumb>
        </div>
        <div class="container">
            <p class="header-Sty">会长</p>
            <el-table :data="President" style="width: 100%">
                <el-table-column
                  label="入团时间"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.t_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="会员姓名"
                  width="180">
                  <template slot-scope="scope">
                        <el-tag size="medium">{{ scope.row.t_name}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="会员角色"
                  width="180">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="success">{{ scope.row.role}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="是否授权登录"
                  width="180">
                  <template slot-scope="scope">
                    <el-button type="info" icon="el-icon-arrow-right" round v-if="scope.row.memberId.clue_right==null" @click="ToLogin(scope.row)">
                    否
                    </el-button>
                    <el-button type="success" icon="el-icon-check" round v-if="scope.row.memberId.clue_right==1" @click="ToShow(scope.row)" :disabled="btndisable">
                    是
                    </el-button>
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
        </div>
        <div class="container user-listtop">
            <p class="header-Sty">副会/干事</p>
            <el-table :data="Dothing" style="width: 100%">
                <el-table-column
                  label="入团时间"
                  width="180">
                  <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.t_time }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  label="会员姓名"
                  width="180">
                  <template slot-scope="scope">
                        <el-tag size="medium">{{ scope.row.t_name}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="会员角色"
                  width="180">
                  <template slot-scope="scope">
                      <el-tag size="medium" type="success">{{ scope.row.role}}</el-tag>
                  </template>
                </el-table-column>

                <el-table-column
                  label="是否授权登录"
                  width="180">
                  <template slot-scope="scope">
                    <el-button type="info" icon="el-icon-arrow-right" round v-if="scope.row.memberId.clue_right==null" @click="ToLogin(scope.row)">
                    否
                    </el-button>
                    <el-button type="success" icon="el-icon-check" round v-if="scope.row.memberId.clue_right==1" @click="ToLogin(scope.row)" >
                    是
                    </el-button>
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
        </div>

        <el-dialog title="会员信息" :visible.sync="dialogFormVisible">
            <el-form :model="ruleForm" ref="ruleForm" label-width="120px" class="demo-ruleForm">

                <el-form-item label="姓名：" >
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


                <el-form-item>
                    <el-button type="danger" @click="Nopasscheck(ruleForm)">不通过</el-button>
                    <el-button type="success" @click="Passcheck(ruleForm)">通过</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name: 'Usercenter',
        data(){
            return{
                Dothing:[],
                President:[],
                btndisable:true,
                dialogFormVisible: false,
                ruleForm: {
                      t_name:'',
                      t_time:'',
                      experience:'',
                      role:'',
                      memberId:'',
                      clubid:''
                },
                imgUrl:'http://www.clubs.org',
                imgsrc:'',

            }
        },
        methods:{
            handleMore(index, row){
                this.dialogFormVisible=true;
                this.imgsrc=this.imgUrl+row.memberId.m_img;
                this.ruleForm=row;
            },
            getAllTable(){
                let huizhang = [];
                let ganshi = [];
                this.$axios.get('http://www.clubs.org/index.php/getAllTable')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        ret.data.forEach((val)=>{
                            if(val.clubId==localStorage.getItem('departId') && val.station==1 
                                && val.role!="普通会员"){
                                this.$axios.get('http://www.clubs.org/index.php/getMember',{params:{id:val.memberId}})
                                .then((memberres)=>{
                                    let memberret=memberres.data;
                                    if(memberret.code == 200){
                                        val.memberId=memberret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                if(val.role=="会长"){
                                    huizhang.push(val);
                                    
                                }else if(val.role == "社团干事" || val.role=="副会长"){
                                    ganshi.push(val);
                                    
                                }
                            }
                        });
                        this.President=huizhang;
                        this.Dothing=ganshi;
                        console.log(this.President);
                        console.log(this.Dothing);
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            ToLogin(row){
                if(row.memberId.clue_right == 1){
                    var params={
                        id:row.memberId.id,
                        depart:null,
                        clue_right:null,
                    };
                }else{
                    var params={
                        id:row.memberId.id,
                        depart:row.clubId,
                        clue_right:1,
                    };  
                }
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'C_editMember',params)
                .then((res)=>{
                    let ret=res.data;
                    // console.log(ret);
                    if(ret.code==200){ 
                        //清空列表重新加载
                        if(row.memberId.clue_right == 1){
                            this.getAllTable();
                            this.common.toastMsg("已取消授权！",'success');
                        }else{
                            this.getAllTable();
                            this.common.toastMsg("已授权！",'success');
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
            handleDelete(index, row) {
                this.$confirm('此操作将移除该会员, 是否继续?', '提示', {
                      confirmButtonText: '确定',
                      cancelButtonText: '取消',
                      type: 'warning'
                    }).then(() => {
                        let membreparams={
                            id:row.memberId.id,
                            clue_right:null,
                            depart:null,
                            role:null
                        };
                        this.$axios.post('http://www.clubs.org/index.php/' + 'C_editMember',membreparams)
                        .then((ret)=>{
                            let result=ret.data;
                            if(result.code==200){
                                this.$axios.get('http://www.clubs.org/index.php/' + 'C_delTable',{params:{id:row.id}})
                                .then((res) =>{
                                    let respose=res.data;
                                    if(respose.code == 200)
                                    {
                                        this.common.toastMsg("已退出社团",'success');
                                        this.getAllTable();
                                      
                                    }else if(respose.code == 101){
                                      this.handleError();
                                    }else{
                                      this.common.toastMsg(respose.error,'warning');
                                    }
                                });
                            }else if(result.code==101){
                                this.handleError();
                            }else{
                                this.common.toastMsg(result.error,'warning'); 
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
    .user-listtop{
        margin-top: 20px;
    }
    .header-Sty{
        color: #757775;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .avator-img{
        width: 100px;
        height: 100px;
    } 
</style>
<template>
    <div>
        <v-header></v-header>
        <div class="writeCon" v-if="showRes">
            <div class="writeCon_cen">
                <div class="writeCen_res">
                    <p>已提交申请！！</p>
                    <p><a href="javascript:;" @click="toMyask">点击这里查看申请详情</a></p>
                </div>
            </div>
        </div>
        <div class="writeCon" v-if="showTable">
            <div class="writeCon_head">
                <p>加入社团申请表</p>
            </div>
            <div class="writeCon_cen" >
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_name">
                        <template slot="prepend">申请人：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_sex">
                        <template slot="prepend">性    别：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_number">
                        <template slot="prepend">学 号：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle">
                    <el-input v-model="memberMes.m_phone">
                        <template slot="prepend">手机号码：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle" style="margin-bottom: 20px;">
                    <el-input v-model="memberMes.m_grade">
                        <template slot="prepend">年    级：</template>
                    </el-input>
                </el-col>
                <el-col :span="11" class="colstyle" style="margin-bottom: 20px;">
                    <el-input v-model="memberMes.m_class">
                        <template slot="prepend">班级：</template>
                    </el-input>
                </el-col>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="130px" class="demo-ruleForm">

                    <el-form-item label="社团名称" prop="clubId">
                        <el-select v-model="ruleForm.clubId" placeholder="请选择社团">
                            <el-option v-for="item in Allclubmes" :key="item.id" 
                            :label="item.c_name" :value="item.id"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="申请角色(职务)" prop="role">
                        <el-select v-model="ruleForm.role" placeholder="请选择角色">
                            <el-option label="会长" value="会长"></el-option>
                            <el-option label="副会长" value="副会长"></el-option>
                            <el-option label="社团干事" value="社团干事"></el-option>
                            <el-option label="普通会员" value="普通会员"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="校园经历" prop="experience">
                        <el-input type="textarea" v-model="ruleForm.experience"></el-input>
                    </el-form-item>


                    <el-form-item label="备注">
                        <el-input type="textarea" v-model="ruleForm.beizhu"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="submitForm('ruleForm')">申请</el-button>
                        <el-button @click="resetForm('ruleForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
        <v-footer></v-footer>    
    </div>
    
</template>

<script>
    import vHeader from './common/Homeheader.vue'
    import vFooter from './common/Homefooter.vue'
    import http from '../../assets/js/http.js'
    export default {
        name:'Joinclub',
        data(){
            return{
                memberMes:'',
                Allclubmes:[],
                ruleForm: {
                    clubId:'',
                    role:'',
                    memberId: sessionStorage.getItem('m_id'),
                    t_name:sessionStorage.getItem('m_name'),
                    experience:'',
                    beizhu: '',
                },
                rules: {
                  clubId: [
                    { required: true, message: '请选择社团', trigger: 'blur' },
                  ],
                  role: [
                    { required: true, message: '请选择社团职务', trigger: 'blur' },
                  ],
                  experience: [
                    { required: true, message: '请填写校园经历', trigger: 'blur' }
                  ],
                },
                showRes:false,
                showTable:true,
            } 
        },
        methods:{
             //获取会员信息
            getMember(){
              let params={
                id:sessionStorage.getItem('m_id')
              };
              // console.log(params);
              this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params}).then((res) => {
                if(res.code == 200){
                  this.memberMes=res.data;
                }else{
                   this.common.toastMsg('信息出错','warn');
                }
              });
              
            },
            toMyask(){
                // Bus.$emit('showAsking',true);
                this.$store.state.showAsking=true; //查看申请详情
                this.$router.push("/Usercenter");

            },
            //获取社团列表
            getAllclub(){
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllClub').then((res) => {
                    if(res.code == 200){
                        res.data.forEach((val)=>{
                            if(val.ispass==1){
                                this.Allclubmes.push(val);
                            }
                        });
                    }else{
                       this.common.toastMsg('信息出错','warn');
                    }
                });
                this.ruleForm.clubId=Number(this.$route.query.id);
            },
            submitForm(formName){
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        // let config = {headers: {'Content-Type': 'multipart/form-data'}};
                        // const instance=this.$axios.create({
                        //   withCredentials: true
                        // });
                        // let params = new FormData();
                        // params.append('c_name',this.ruleForm.c_name);
                        // params.append('c_createrId',this.ruleForm.c_createrId);
                        // params.append('c_manage',this.ruleForm.c_manage);
                        // params.append('c_img',this.ruleForm.c_img);
                        // params.append('c_nature',this.ruleForm.c_nature);
                        // params.append('c_introduce',this.ruleForm.c_introduce);
                        // params.append('beizhu',this.ruleForm.beizhu);
                        this.apiPost( 'http://www.clubs.org/index.php/' + 'joinClub',this.ruleForm).then((res) => {
                          if(res.code == 200){
                            this.common.toastMsg('已提交申请','success'); 
                            this.showRes=true; 
                            this.showTable=false;
             
                          }else if(res.code == 101){
                            this.handleError();
                          }else{
                            this.common.toastMsg(res.error,'warning');
                          }
                        }); 
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },

            resetForm(formName) {
               this.$refs[formName].resetFields();
            },

        },
        mounted(){
            this.getMember();
            this.getAllclub();
        },
        components: {
          vHeader,
          vFooter
        },
        mixins:[http],
    }
</script>

<style scoped>
.writeCon{
    width: 1200px;
    min-height: 550px;
    margin: 0 auto;
    margin-top: 14px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px #999;
}
.writeCon_head{
    width: 100%;
    height: 50px;
    border-radius: 10px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #d7d7d7;
} 
.writeCon_head p{
    font-size: 15px;
    color: #7F8182;
    line-height: 50px;
    text-indent: 25px;
}
.writeCon_cen{
    width: 700px;
    min-height: 500px;
    margin: 0 auto;
    margin-top: 20px;
    padding-bottom: 20px;
}
.writeCen_res{
    padding-top: 40%;
}
.writeCen_res p:nth-of-type(1){
    font-size: 25px;
    color: #008837;
    font-weight: bold;
    letter-spacing: 5px;
}
.writeCen_res p:nth-of-type(2){
    font-size: 16px; 
    margin-top: 10px;
}
.colstyle
{
    margin-left: 15px;
    margin-top: 20px;
}
</style>
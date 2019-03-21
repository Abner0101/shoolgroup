<template>
    <div class="Myset">
        <el-tabs type="border-card" style="border-radius: 15px;margin: 15px 25px;">

            <el-tab-pane label="我的资料">
                <el-form :model="memberMes"  ref="memberMes" label-width="100px" class="demo-ruleForm">
                    <el-form-item label="会员姓名">
                      <el-col :span="11">
                        <el-input v-model="memberMes.m_name"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="性别">
                        <el-radio-group v-model="memberMes.m_sex">
                          <el-radio label="男"></el-radio>
                          <el-radio label="女"></el-radio>
                        </el-radio-group>
                    </el-form-item>

                    <el-form-item label="生日">
                      <el-col :span="11">
                          <el-date-picker type="date" placeholder="选择日期" v-model="memberMes.m_birthday" style="width: 100%;"></el-date-picker>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="届时">
                      <el-col :span="11">
                        <el-input v-model="memberMes.m_grade"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="学号">
                      <el-col :span="11">
                        <el-input v-model="memberMes.m_number"></el-input>
                      </el-col>
                    </el-form-item>
                    
                    <el-form-item label="专业班级">
                      <el-col :span="11">
                        <el-input v-model="memberMes.m_class"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="手机号码">
                      <el-col :span="11">
                        <el-input v-model="memberMes.m_phone"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="所属社团">
                      <el-col :span="11">
                        <el-input v-model="memberMes.depart" :disabled="true"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item label="社团职务">
                      <el-col :span="11">
                        <el-input v-model="memberMes.role" :disabled="true"></el-input>
                      </el-col>
                    </el-form-item>

                    <el-form-item>
                      <el-button type="primary" @click="editMember('memberMes')">修改</el-button>
                    </el-form-item>
                  </el-form>
          </el-tab-pane>

          <el-tab-pane label="头像">
            <div class="baseCon">
                <el-upload  class="avatar-uploader" :before-upload="beforeEditImgUpload" 
                  accept="image/png,image/jpeg,image/gif,image/jpg,image/webp" 
                  action="http://www.clubs.org/index.php/editMember" 
                  :on-success="handleAvatarSuccess"
                  :data="Image"
                  :headers="Header">
                  <img v-if="editImgSrc" :src="editImgSrc" class="avatar">
                  <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                  <div class="el-upload__tip" slot="tip">支持上传jpg/gif/png/jpeg/webp图片</div>
                </el-upload>
            </div>
          </el-tab-pane>


          <el-tab-pane label="修改密码">
            <el-form :model="passWord" :rules="rules" ref="passWord" label-position="left" label-width="0px" class="demo-ruleForm card-box loginform"  style="margin-left: 30%;margin-top: 80px;margin-bottom: 200px">
                    <el-form-item prop="m_password" >
                      <el-col :span="15">
                        <el-input type="password" placeholder="新密码" v-model="passWord.m_password" :disabled='IsDisabled' suffix-icon="el-icon-goods"></el-input>
                      </el-col>
                    </el-form-item>
                    <el-form-item prop="m_phone" >
                      <el-col :span="15">
                        <el-input type="text" placeholder="手机号码" v-model="passWord.m_phone"  suffix-icon="el-icon-mobile-phone" :disabled="true"></el-input>
                      </el-col>
                    </el-form-item>
                    <el-form-item prop="code" >
                      <el-col :span="15">
                        <el-input type="text" placeholder="短信验证码" v-model="passWord.code" :disabled='IsDisabled' style="width:67%;"  suffix-icon="el-icon-more-outline"></el-input>
                        <el-button type="primary" style="width:30%;" @click="getsms()" :disabled="smsDisable">{{sms}}</el-button>
                      </el-col>
                    </el-form-item>
                    <el-form-item>
                      <el-col :span="15">
                        <el-button type="primary" style="width:100%;" v-loading="loading" @click="editPassword('passWord')">修改</el-button>
                      </el-col>
                    </el-form-item>
            </el-form>
          </el-tab-pane>

        </el-tabs>
    </div>
</template>

<script>
    import http from '../../../../assets/js/http.js'
    export default {
        name:'Myset',
        data() {
            return{
              memberMes:{
                m_name:'',
                m_number:'',
                m_sex:'',
                m_grade:'',
                m_class:'',
                depart:'',
                m_phone:'',
                m_birthday:'',
                role:'',
              },

              Image:{
                id:sessionStorage.getItem('m_id'),
                m_img:'',
              },

              passWord:{
                id:sessionStorage.getItem('m_id'),
                m_password:'',
                m_phone:'',
                code:''
              },

              imgUrl:'http://www.clubs.org',
              editImgSrc:'',
              Header:{
                authkey:sessionStorage.getItem('authKey'),
                sessionid:sessionStorage.getItem('sessionId')
              },
              loading:false,
              IsDisabled:false,
              smsDisable:false,
              sms:"获取验证码",

              rules:{
                m_password:[
                  {required:true,message:'请输入新密码',trigger:'blur'}
                ],
                code:[
                  {required:true,message:'请输入短信验证码',trigger:'blur'}
                ],
              }

            }
        },
        methods: {
          //编辑会员信息
            editMember(memberMes) {
                this.$confirm('是否要保存修改？', '确认信息', {
                  distinguishCancelAndClose: true,
                  confirmButtonText: '保存',
                  cancelButtonText: '放弃修改',
                   type: 'warning'
                })
                  .then(() => {
                    // let Memberform=this.memberMes;
                    // Memberform['id']=sessionStorage.getItem('m_id');
                    // console.log(Memberform);
                    this.$refs[memberMes].validate((valid) => {
                        if (valid) {
                            this.apiPost('http://www.clubs.org/index.php/' + 'editMember',this.memberMes)
                            .then((res) =>{
                              if(res.code == 200)
                              {
                                this.common.toastMsg(res.data,'success');
                                this.getMember();
                                
                              }else if(res.code == 101){
                                this.handleError();
                              }else{
                                this.common.toastMsg(res.error,'warning');
                              }
                          })
                        } else {
                            console.log('error submit!!');
                            return false;
                        }
                    });
                  })
                  .catch(() => {
                    this.$message({
                      type: 'info',
                      message: '已取消修改'
                    });          
                  });
            },

            editPassword(passWord){
              if(this.loading) return
              this.$refs[passWord].validate((valid) => {
                  if (valid) {
                    this.loading = !this.loading;
                    this.IsDisabled = !this.IsDisabled;
                    this.apiPost( 'http://www.clubs.org/index.php/' + 'editMember',this.passWord).then((res) => {
                      if(res.code == 200){
                        // localStorage.setItem('authKey',res.data.authKey);
                        // localStorage.setItem('sessionId',res.data.sessionId);
                        // localStorage.setItem('m_number',res.data.userInfo.m_number);
                        
                        this.common.toastMsg('密码修改成功','success'); 
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                        this.getMember();  
         
                      }else if(res.code == 101){
                        this.handleError();
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                      }else{
                        this.common.toastMsg(res.error,'warning');
                        this.loading = !this.loading;
                        this.IsDisabled = !this.IsDisabled;
                      }
                    })      
                  } else {
                    return false;
                  }
                })
            },

            //获取验证码
            getsms(){
                // console.log(this.RegMessage);
                // if(this.showPhoneLogin){
                //     var Message=this.PhoneMessage;
                // }
                // if(this.showReg){
                //     var Message=this.RegMessage;
                // }
                this.apiPost( 'http://www.clubs.org/index.php/' + 'getSms',this.passWord).then((res)=>{
                        if(res.status=true){
                            this.smsDisable=true;
                            var second=60;
                            var t1=setInterval(()=>{
                                // console.log(second);
                                second--;
                                this.sms=second+'秒';
                                if(second==0){
                                    clearInterval(t1);
                                    this.smsDisable=false;
                                    this.sms='获取验证码';
                                }
                            }, 1000); 
                        }
                    }
                )
            },

            //获取会员信息
            getMember(){
              let params={
                id:sessionStorage.getItem('m_id')
              };
              // console.log(memberid);
              this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params}).then((res) => {
                if(res.code == 200){
                  this.memberMes=res.data;
                  this.memberMes.code=null;
                  this.passWord.code="";
                  this.passWord.m_phone=res.data.m_phone;
                  this.passWord.m_password="";
                  this.editImgSrc = this.imgUrl + res.data.m_img;
                }else{
                   this.common.toastMsg('信息出错','warn');
                }
              });
              
            },

            //头像上传前触发函数
            beforeEditImgUpload(file){
              this.editImgSrc = window.URL.createObjectURL(file);
              this.Image.m_img = file;
              // console.log(this.memberMes);
              // return false;
            },

            //头像上传成功触发函数
            handleAvatarSuccess(res, file) {
              if(res.code == 200){
                this.getMember();
                this.common.toastMsg('上传成功','success');
              }else{
                // console.log(res.code);
                this.handleError();
              }  
            },



        },
        mounted(){
          this.getMember(); 
        },
        mixins:[http],
    }
</script>

<style>
.baseCon{
    width: 250px;
    height: 300px;
    padding: 20px 40px;
    margin-left: 30%;
    margin-top: 30px;
    margin-bottom: 50px;
    background:#f2f2f2; 
    border-radius: 10px;
}


.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    width: 250px;
    height: 250px;
}
.avatar-uploader .el-upload:hover {
    border-color: #409EFF;
}
.avatar-uploader-icon {
    font-size: 40px;
    color: #8c939d;
    width: 250px;
    height: 250px;
    line-height: 250px;
    text-align: center;
}
.avatar {
    width: 250px;
    height: 250px;
    display: block;
}
</style>
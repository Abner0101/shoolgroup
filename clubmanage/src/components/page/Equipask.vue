<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-text"></i> 申请表</el-breadcrumb-item>
                <el-breadcrumb-item>添加申请</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container" v-if="showask">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                <el-form-item label="申请类型" prop="e_nature">
                    <el-select v-model="ruleForm.e_nature" placeholder="请选择申请性质">
                      <el-option label="课室" value="课室"></el-option>
                      <el-option label="场地" value="场地"></el-option>
                      <el-option label="器材" value="器材"></el-option>
                      <el-option label="经费" value="经费"></el-option>
                      <el-option label="设备" value="设备"></el-option>
                    </el-select>
                </el-form-item>

                <el-form-item label="申请内容" prop="e_content">
                    <el-input v-model="ruleForm.e_content"></el-input>
                </el-form-item>

                <el-form-item label="使用时间" prop="e_time">
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
                    <el-button @click="resetForm('ruleForm')">重置</el-button>
                </el-form-item>
            </el-form>
        </div>

        <div class="container" v-if="showres">
            <el-button type="primary" @click="reAsk()">继续申请</el-button>
            <el-button type="primary" @click="ToEquiplist()">申请详情</el-button>
            <h1 class="asksus">您已成功申请！</h1> 
        </div>


    </div>
</template>

<script>
    import http from '../../assets/js/http.js'
    export default {
        name: 'Equipask',
        data() {
            return {
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
                showask:true,
                showres:false,
            }
        },
        methods:{
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                  if (valid) {
                    this.ruleForm.e_time= this.ruleForm.e_time[0] + "至" + this.ruleForm.e_time[1];
                    this.$axios
                    .post('http://www.clubs.org/index.php/' + 'addEquip',this.ruleForm)
                    .then((res)=>{
                        let ret=res.data;
                        if(ret.code==200){
                            this.common.toastMsg('申请成功','success');
                            this.showask=false;
                            this.showres=true;
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
            ToEquiplist(){
                setTimeout(()=>{
                    // window.location.reload();
                    this.$router.push('/equiplist');
                },1500);
            },
            reAsk(){
                this.showask=true;
                this.showres=false;
                this.resetForm('ruleForm');
                this.getclubname();
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            getclubname(){
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getClub',{params:{id:localStorage.getItem('departId')}})
                .then((res)=>{
                    let ret =res.data;
                    if(ret.code==200){
                        this.ruleForm.e_clubname=ret.data.c_name;
                    }else{
                        this.handleError();
                    }
                });
            }
        },
        mounted(){
            this.getclubname();
        },


    }
</script>

<style scoped>
  .asksus{
        color: #05A30B;
        margin-top: 20px;
        margin-bottom: 20px;
    }    
</style>
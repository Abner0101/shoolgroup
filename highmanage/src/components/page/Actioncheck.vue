<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-group"></i> 活动管理</el-breadcrumb-item>
                <el-breadcrumb-item>活动审核</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="drag-box">
                <div class="drag-box-item">
                    <div class="item-title">未审核</div>
                    <draggable v-model="wait" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="未审核" class="item-ul">
                            <div v-for="item in wait" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.a_theme}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核通过</div>
                    <draggable v-model="pass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核通过" class="item-ul">
                            <div v-for="item in pass" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.a_theme}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核不通过</div>
                    <draggable v-model="nopass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核不通过" class="item-ul">
                            <div v-for="item in nopass" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.a_theme}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
            </div>


            <el-dialog title="活动详情" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="活动主题：" prop="a_theme">
                        {{ruleForm.a_theme}}
                    </el-form-item>

                    <el-form-item label="活动性质：" >
                        {{ruleForm.a_nature}}
                    </el-form-item>

                    <el-form-item label="封面图片：">
                        <el-upload  class="avatar-uploader" :before-upload="beforeAddImgUpload"
                            accept="image/png,image/jpeg,image/gif,image/jpg,image/webp" 
                            action="http://www.clubs.org/index.php/addAction" 
                            >
                            <img v-if="addImg" :src="addImg" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            <div class="el-upload__tip" slot="tip">支持上传jpg/gif/png/jpeg/webp图片</div>
                        </el-upload>
                    </el-form-item>

                    <el-form-item label="活动内容：" >
                        <div class="ql-container ql-snow">
                            <div class="ql-editor">
                               <div v-html="ruleForm.a_content"></div>
                            </div>
                        </div>
                    </el-form-item>
                    
                    <el-form-item label="活动日期：">
                        {{ruleForm.a_hdday}}
                    </el-form-item>

                    <el-form-item label="活动地点：">
                        {{ruleForm.a_hdplace}}
                    </el-form-item>

                    <el-form-item label="承办社团：" >
                        {{ruleForm.a_unit}}
                    </el-form-item>

                    <el-form-item label="活动负责人：">
                        {{ruleForm.a_manager}}
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
    </div>
</template>
<script>
    import 'quill/dist/quill.core.css';
    import 'quill/dist/quill.snow.css';
    import 'quill/dist/quill.bubble.css';
    import draggable from 'vuedraggable'
    import http from '../../assets/js/http.js'
    export default {
    data() {
      return {
        dragOptions:{
            animation: 120,
            scroll: true,
            group: 'sortlist',
            ghostClass: 'ghost-style'
        },
        dialogFormVisible: false,
        wait: [],
        pass: [],
        nopass:[],
        ruleForm: {
              a_theme:'',
              a_hdday:'',
              a_hdplace:'',
              a_manager:'',
              a_hdchecker:'',
              a_unit:'',
              coverimg:null,
              a_nature:'',
              a_content:'',
              beizhu:'',
              clubid:''
        },
        addImg:'',//图片路径显示
        imgUrl:'http://www.clubs.org',
      }
    },
    components:{
        draggable
    },
    methods:{
        //查看申请活动
        Check(item){
            this.dialogFormVisible=true;
            this.addImg=this.imgUrl+item.coverimg;
            this.ruleForm=item;
            // console.log(item);
        },

        Passcheck(ruleForm){
            // console.log(Askmess);
            let params={
                id:ruleForm.id,
                a_hdchecker:localStorage.getItem('username'),
                ispass:1
            };
            
            this.$axios
            .post('http://www.clubs.org/index.php/' + 'M_editAction',params)
            .then((res)=>{
                let ret=res.data;
                console.log(ret);
                if(ret.code==200){ 
                    //清空列表重新加载
                    this.dialogFormVisible=false;
                    this.common.toastMsg("审核通过",'success');
                    this.wait=[];
                    this.pass=[];
                    this.nopass=[];
                    this.getActionMes();
                }
                else if(ret.code == 101){
                    this.handleError();
                }
                else{
                    this.common.toastMsg(ret.error,'warning');
                }
            });
        },
        Nopasscheck(ruleForm){
            let params={
                id:ruleForm.id,
                ispass:0
            }
            this.$axios
            .post('http://www.clubs.org/index.php/' + 'M_editAction',params)
            .then((res)=>{
                let ret=res.data;
                if(ret.code==200){
                    this.dialogFormVisible=false;
                    this.common.toastMsg('审核不通过','warning'); 
                    //清空列表重新加载
                    this.wait=[];
                    this.pass=[];
                    this.nopass=[];
                    this.getActionMes();
                }else if(ret.code==101){
                    this.handleError();
                }else{
                    this.common.toastMsg(ret.error,'error'); 
                }
            });
        },
        getActionMes(){
            this.$axios.get('http://www.clubs.org/index.php/getAllAction')
            .then((res)=>{
                let ret=res.data;
                if(ret.code == 200){
                    console.log(ret.data);
                    ret.data.forEach((val)=>{
                        if(val.ispass==2){
                            this.wait.push(val);
                        }else if(val.ispass==1){
                            this.pass.push(val);
                        }else{
                            this.nopass.push(val);
                        }
                    });
                }else{
                    this.common.toastMsg('信息出错','warn');
                }
            });
        },
        //图片上传前触发函数
        beforeAddImgUpload(file){
          this.addImg = window.URL.createObjectURL(file);
          this.ruleForm.coverimg = file;
          // console.log(this.ruleForm.coverimg);
          return false;
        },
        removeHandle(event){
            console.log(event);
            this.$message.success(`从 ${event.from.id} 移动到 ${event.to.id} `);
        },
    },
    mounted(){
        this.getActionMes();
    },
    mixins:[http],
}
</script>

<style scoped>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width: 350px;
        height: 180px;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 40px;
        color: #8c939d;
        width: 360px;
        height: 180px;
        line-height: 180px;
        text-align: center;
    }
    .avatar {
        width: 360px;
        height: 180px;
        display: block;
    }  
/* 审核样式 */
    .drag-box{
        display: flex;
        user-select: none;
    }
    .drag-box-item {
        flex: 1;
        max-width: 330px;
        min-width: 300px;
        background-color: #eff1f5;
        margin-right: 16px;
        border-radius: 6px;
        border: 1px #e1e4e8 solid;
    }
    .item-title{
        padding: 8px 8px 8px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #24292e;
        font-weight: 600;
    }
    .item-ul{
        padding: 0 8px 8px;
        height: 500px;
        overflow-y: scroll;
    }
    .item-ul::-webkit-scrollbar{
        width: 0;
    }
    .drag-list {
        border: 1px #e1e4e8 solid;
        padding: 10px;
        margin: 5px 0 10px;
        list-style: none;
        background-color: #fff;
        border-radius: 6px;
        cursor: pointer;
        -webkit-transition: border .3s ease-in;
        transition: border .3s ease-in;
    }
    .drag-list:hover {
        border: 1px solid #20a0ff;
    }
    .drag-title {
        font-weight: 400;
        line-height: 25px;
        margin: 10px 0;
        font-size: 22px;
        color: #1f2f3d;
    }
    .ghost-style{
        display: block;
        color: transparent;
        border-style: dashed
    }     
</style>
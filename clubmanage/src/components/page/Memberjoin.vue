<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-friend"></i> 会员管理</el-breadcrumb-item>
                <el-breadcrumb-item>入团审核</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="drag-box">
                <div class="drag-box-item">
                    <div class="item-title">未审核</div>
                    <draggable v-model="wait" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="未审核" class="item-ul">
                            <div v-for="item in wait" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.t_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核通过</div>
                    <draggable v-model="pass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核通过" class="item-ul">
                            <div v-for="item in pass" class="drag-list" :key="item.id">
                                {{item.t_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核不通过</div>
                    <draggable v-model="nopass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核不通过" class="item-ul">
                            <div v-for="item in nopass" class="drag-list" :key="item.id">
                                {{item.t_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
            </div>
        </div>

        <el-dialog title="申请表" :visible.sync="dialogFormVisible">
            <el-form :model="ruleForm" ref="ruleForm" label-width="120px" class="demo-ruleForm">

                <el-form-item label="申请人：">
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

                <el-form-item label="申请角色：" >
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
    import draggable from 'vuedraggable'
    import http from '../../assets/js/http.js'
    export default {
        name: 'Memberjoin',
        data(){
            return{
                dragOptions:{
                    animation: 120,
                    scroll: true,
                    group: 'sortlist',
                    ghostClass: 'ghost-style'
                },
                wait: [],
                pass: [],
                nopass:[],
                imgUrl:'http://www.clubs.org',
                imgsrc:'',
                dialogFormVisible: false,
                ruleForm: {
                      t_name:'',
                      t_time:'',
                      experience:'',
                      role:'',
                      memberId:'',
                      clubid:''
                },

            }
        },
        methods:{
            removeHandle(event){
                // console.log(event);
                this.$message.success(`从 ${event.from.id} 移动到 ${event.to.id} `);
            },
            Check(item){
                this.dialogFormVisible=true;
                this.imgsrc=this.imgUrl+item.memberId.m_img;
                this.ruleForm=item;
                // console.log(item);
            },
            Passcheck(ruleForm){
                // console.log(Askmess);
                let params={
                    id:ruleForm.id,
                    t_time:this.common.getNowtime(),//获取当前时间
                    station:1
                };
                
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'C_editTable',params)
                .then((res)=>{
                    let ret=res.data;
                    // console.log(ret);
                    if(ret.code==200){ 
                        //清空列表重新加载
                        // if(ruleForm.role=="会长"){
                        //     if(ruleForm.memberId.clue_right==1){
                        //         this.common.toastMsg("你已是社团管理员",'warning');
                        //     }
                        //     let member={
                        //         id:this.ruleForm.memberId.id,
                        //         clue_right:1,
                        //         depart:this.ruleForm.clubId,
                        //         role:"会长"
                        //     };
                        //     this.$axios.post('http://www.clubs.org/index.php/' + 'C_editMember',member)
                        //     .then((memberres)=>{
                        //         let memberret=memberres.data;
                        //         if(memberret.code == 200){
                        //             this.dialogFormVisible=false;
                        //             this.common.toastMsg("审核通过",'success');
                        //             this.wait=[];
                        //             this.pass=[];
                        //             this.nopass=[];
                        //             this.getAllTable();
                        //         }else if(memberret.code == 101){
                        //             this.handleError();
                        //         }else{
                        //             this.common.toastMsg(ret.error,'warning');
                        //         }
                        //     });
                        // }else{
                            this.dialogFormVisible=false;
                            this.common.toastMsg("审核通过",'success');
                            this.wait=[];
                            this.pass=[];
                            this.nopass=[];
                            this.getAllTable();
                        // } 
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
                    t_time:'',
                    station:0
                }
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'C_editTable',params)
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code==200){
                        this.dialogFormVisible=false;
                        this.common.toastMsg('审核不通过','warning'); 
                        //清空列表重新加载
                        this.wait=[];
                        this.pass=[];
                        this.nopass=[];
                        this.getAllTable();
                    }else if(ret.code==101){
                        this.handleError();
                    }else{
                        this.common.toastMsg(ret.error,'error'); 
                    }
                });
            },
            getAllTable(){
                this.$axios.get('http://www.clubs.org/index.php/getAllTable')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        ret.data.forEach((val)=>{
                            if(val.clubId==localStorage.getItem('departId')){
                                this.$axios.get('http://www.clubs.org/index.php/getMember',{params:{id:val.memberId}})
                                .then((memberres)=>{
                                    let memberret=memberres.data;
                                    if(memberret.code == 200){
                                        val.memberId=memberret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                if(val.station==2){
                                    this.wait.push(val);
                                }else if(val.station==1){
                                    this.pass.push(val);
                                }else{
                                    this.nopass.push(val);
                                }
                            }
                        });
                        console.log(ret.data);
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },

        },
        components:{
            draggable
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
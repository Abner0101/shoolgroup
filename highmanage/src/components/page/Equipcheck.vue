<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-text"></i> 申请管理</el-breadcrumb-item>
                <el-breadcrumb-item>申请审核</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="drag-box">
                <div class="drag-box-item">
                    <div class="item-title">未审核</div>
                    <draggable v-model="wait" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="未审核" class="item-ul">
                            <div v-for="item in wait" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.e_nature}}-{{item.e_clubname}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核通过</div>
                    <draggable v-model="pass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核通过" class="item-ul">
                            <div v-for="item in pass" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.e_nature}}-{{item.e_clubname}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核不通过</div>
                    <draggable v-model="nopass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核不通过" class="item-ul">
                            <div v-for="item in nopass" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.e_nature}}-{{item.e_clubname}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
            </div>

            <el-dialog title="申请详情" :visible.sync="dialogFormVisible">
                <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">

                    <el-form-item label="申请类型：" >
                        {{ruleForm.e_nature}}
                    </el-form-item>

                    <el-form-item label="申请内容：" >
                        {{ruleForm.e_content}}
                    </el-form-item>

                    <el-form-item label="使用时段：" >
                        {{ruleForm.e_time}}
                    </el-form-item>
                    
                    <el-form-item label="原因/用途：">
                        {{ruleForm.e_purpose}}
                    </el-form-item>

                    <el-form-item label="申请社团：">
                        {{ruleForm.e_clubname}}
                    </el-form-item>

                    <el-form-item label="申请人：" >
                        {{ruleForm.e_man}}
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
    import draggable from 'vuedraggable'
    import http from '../../assets/js/http.js'
    export default {
        name:'Equipcheck',
        data() {
            return {
                dragOptions:{
                    animation: 120,
                    scroll: true,
                    group: 'sortlist',
                    ghostClass: 'ghost-style'
                },
                ruleForm: {
                  e_content:'',
                  e_time:'',
                  e_man:'',
                  e_clubId:'',
                  e_clubname:'',
                  e_nature:'',
                  e_purpose:'',
                  beizhu:''
                },
                dialogFormVisible: false,
                wait: [],
                pass: [],
                nopass:[],
            }
        },
        methods:{
            Check(item){
                this.dialogFormVisible=true;
                this.ruleForm=item;
                // console.log(item);
            },
            Passcheck(ruleForm){
                // console.log(Askmess);
                let params={
                    id:ruleForm.id,
                    e_checker:localStorage.getItem('username'),
                    ispass:1
                };                
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'M_editEquip',params)
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
                        this.getEquipMes();
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
                    e_checker:localStorage.getItem('username'),
                    ispass:0
                }
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'M_editEquip',params)
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code==200){
                        this.dialogFormVisible=false;
                        this.common.toastMsg('审核不通过','warning'); 
                        //清空列表重新加载
                        this.wait=[];
                        this.pass=[];
                        this.nopass=[];
                        this.getEquipMes();
                    }else if(ret.code==101){
                        this.handleError();
                    }else{
                        this.common.toastMsg(ret.error,'error'); 
                    }
                });
            },
            getEquipMes(){
                this.$axios.get('http://www.clubs.org/index.php/getAllEquip')
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
            removeHandle(event){
                console.log(event);
                this.$message.success(`从 ${event.from.id} 移动到 ${event.to.id} `);
            },

        },
        mounted(){
            this.getEquipMes();
        },
        components:{
            draggable
        },
        mixins:[http],
    }

</script>

<style scoped>
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

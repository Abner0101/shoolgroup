<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-lx-group"></i> 社团管理</el-breadcrumb-item>
                <el-breadcrumb-item>社团审核</el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <div class="container">
            <div class="drag-box">
                <div class="drag-box-item">
                    <div class="item-title">未审核</div>
                    <draggable v-model="wait" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="未审核" class="item-ul">
                            <div v-for="item in wait" class="drag-list" :key="item.id" @click="Check(item)">
                                {{item.c_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核通过</div>
                    <draggable v-model="pass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核通过" class="item-ul">
                            <div v-for="item in pass" class="drag-list" :key="item.id" >
                                {{item.c_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <div class="drag-box-item">
                    <div class="item-title">审核不通过</div>
                    <draggable v-model="nopass" @remove="removeHandle" :options="dragOptions">
                        <transition-group tag="div" id="审核不通过" class="item-ul">
                            <div v-for="item in nopass" class="drag-list" :key="item.id" >
                                {{item.c_name}}
                            </div>
                        </transition-group>
                    </draggable>
                </div>
                <el-dialog title="建团申请表" :visible.sync="dialogFormVisible">
                    <el-form :model="Askmess" class="colstyle"> 
                        <el-col :span="11" >
                            <el-form-item label="申请人：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_name" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11" >
                            <el-form-item label="性别：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_sex" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="学号：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_number" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="手机号码：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_phone" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="届时：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_grade" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="班级：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_createrId.m_class" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="社团名称：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_name" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="11">
                            <el-form-item label="社团性质：" :label-width="formLabelWidth">
                              <el-input v-model="Askmess.c_nature" autocomplete="off"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-form-item label="主管单位：" :label-width="formLabelWidth">
                            <el-input v-model="Askmess.c_manage" autocomplete="off" style="width:620px;"></el-input>
                        </el-form-item>
                        <el-form-item label="社团简介：" :label-width="formLabelWidth">
                            <el-input type="textarea" v-model="Askmess.c_introduce" style="width:620px;"></el-input>
                        </el-form-item>
                        <el-form-item label="备注：" :label-width="formLabelWidth">
                            <el-input type="textarea" v-model="Askmess.beizhu" style="width:620px;"></el-input>
                        </el-form-item>
                    </el-form>
                    <div class="btnpos">
                        <el-button type="danger" @click="Nopasscheck(Askmess.id)">不通过</el-button>
                        <el-button type="success" @click="Passcheck(Askmess)">通  过</el-button>
                    </div>
                </el-dialog>
            </div>
        </div>

    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import http from '../../assets/js/http.js'
    export default {
        name: 'clubcheck',
        data() {
            return {
                dragOptions:{
                    animation: 120,
                    scroll: true,
                    group: 'sortlist',
                    ghostClass: 'ghost-style'
                },
                wait: [],
                pass: [],
                nopass:[],

                dialogFormVisible: false,
                Askmess:{
                    c_name:'',
                    c_boss:'',
                    c_createrId:{
                        m_name:'',
                        m_sex:'',
                        m_phone:'',
                        m_number:'',
                        m_grade:'',
                        m_class:''
                    },
                    c_manage:'',
                    c_nature:'',
                    c_introduce:'',
                    c_biezhu:'',
                    create_time:'',
                },
                
                formLabelWidth: '120px'
            }
        },
        components:{
            draggable
        },
        mounted(){
            this.getAllclub();
        },
        methods: {

            //查看申请表
            Check(item){
                this.dialogFormVisible=true;
                this.Askmess=item;
                // console.log(item);
            },

            //审核不通过
            Nopasscheck(id){
                let params={
                    id:id,
                    ispass:0,
                    beizhu:this.Askmess.beizhu
                }
                this.$axios
                .post('http://www.clubs.org/index.php/' + 'M_editClub',params)
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code==200){
                        this.dialogFormVisible=false;
                        this.common.toastMsg('审核不通过','warning'); 
                        //清空列表重新加载
                        this.wait=[];
                        this.pass=[];
                        this.nopass=[];
                        this.getAllclub();
                    }else if(ret.code==101){
                        this.handleError();
                    }else{
                        this.common.toastMsg(ret.error,'error'); 
                    }
                });
            },
            //审核通过
            Passcheck(Askmess){
                // console.log(Askmess);
                let table={
                    t_name:Askmess.c_createrId.m_name,
                    station:1,
                    role:"会长",
                    memberId:Askmess.c_createrId.id,
                    clubId:Askmess.id,
                    t_time:this.common.getNowtime()
                };
                
                this.$axios.post('http://www.clubs.org/index.php/' + 'M_addTable',table)
                .then((res)=>{
                    let ret=res.data;
                    console.log(ret);
                    if(ret.code==200){ 
                        const that = this; //指向全局的this
                        this.$axios.all([this.editClub(),this.editMember()])//并发请求
                        .then(this.$axios.spread((club,member)=>{
                            let clubres=club.data;
                            let memberres=member.data;
                            console.log(clubres);
                            console.log(memberres);
                            if(clubres.code==200 && memberres.code==200){
                                this.dialogFormVisible=false;
                                that.common.toastMsg('审核通过','success');
                            }else if(clubres.code==101 || memberres.code==101){
                                that.handleError();
                            }else{
                                that.common.toastMsg("数据出错",'warning');
                            }
                        }));

                        //清空列表重新加载
                        this.wait=[];
                        this.pass=[];
                        this.nopass=[];
                        this.getAllclub();
                    }else if(ret.code == 101){
                        this.handleError();
                    }else{
                        this.common.toastMsg(ret.error,'warning');
                    }
                });
            },

            // addTable(){
            //     let table={
            //         t_name:this.Askmess.c_createrId.m_name,
            //         station:1,
            //         role:"会长",
            //         memberId:this.Askmess.c_createrId.id,
            //         clubId:this.Askmess.id,
            //         t_time:this.common.getNowtime()
            //     };
            //     return this.$axios.post('http://www.clubs.org/index.php/' + 'M_addTable',table);
            // },
            editClub(){
                let params={
                    id:this.Askmess.id,
                    c_boss:this.Askmess.c_createrId.m_name,
                    ispass:1,
                    beizhu:this.Askmess.beizhu
                };
                return this.$axios.post('http://www.clubs.org/index.php/' + 'M_editClub',params);
            },

            editMember(){
                let member={
                    id:this.Askmess.c_createrId.id,
                    clue_right:1,
                    depart:this.Askmess.id,
                    role:"会长"
                } 
                return this.$axios.post('http://www.clubs.org/index.php/' + 'M_editMember',member);
            },

            removeHandle(event){
                console.log(event);
                this.$message.success(`从 ${event.from.id} 移动到 ${event.to.id} `);
            },

            //加载列表
            getAllclub(){
                this.$axios
                .get('http://www.clubs.org/index.php/' + 'getAllClub')
                .then((res)=>{
                    let respose=res.data;
                    if(respose.code == 200){
                        // let temp1 =[];
                        // let temp2 =[];
                        // let temp3 =[];
                        respose.data.forEach((val)=>{
                            val.c_createdate=this.common.toDate(val.create_time);//时间戳转为字符串
                            this.$axios
                            .get('http://www.clubs.org/index.php/' + 'getMember',{params:{id:val.c_createrId}})
                            .then((res)=>{
                                let ret=res.data;
                                if(ret.code == 200){
                                    val.c_createrId=ret.data
                                }else{
                                   this.common.toastMsg(ret.error,'error'); 
                                }
                            });//获取申请人信息

                            if(val.ispass==2){
                                this.wait.push(val);
                            }else if(val.ispass==1){
                                this.pass.push(val)
                            }else{
                                this.nopass.push(val)
                            }
                        });

                    }else{
                        this.common.toastMsg(respose.error,'error');
                    }
                });
                // console.log(this.wait);
            }
        },
        mixins:[http],
    }
</script>

<style scoped>
.colstyle
{
    padding: 0 20px;
}
.btnpos{
    margin-left: 40%;
}
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
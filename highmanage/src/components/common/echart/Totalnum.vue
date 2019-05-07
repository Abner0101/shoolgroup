<template>
    <div>
        <el-row :gutter="20" class="mgb20">
                    <el-col :span="8">
                        <el-card shadow="hover" :body-style="{padding: '0px'}">
                            <div class="grid-content grid-con-1">
                                <i class="el-icon-lx-people grid-con-icon"></i>
                                <div class="grid-cont-right">
                                    <div class="grid-num">{{Membernum}}</div>
                                    <div>会员</div>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                    <el-col :span="8">
                        <el-card shadow="hover" :body-style="{padding: '0px'}">
                            <div class="grid-content grid-con-2">
                                <i class="el-icon-lx-notification grid-con-icon"></i>
                                <div class="grid-cont-right">
                                    <div class="grid-num">{{Actionnum}}</div>
                                    <div>公告</div>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                    <el-col :span="8">
                        <el-card shadow="hover" :body-style="{padding: '0px'}">
                            <div class="grid-content grid-con-3">
                                <i class="el-icon-lx-group grid-con-icon"></i>
                                <div class="grid-cont-right">
                                    <div class="grid-num">{{Clubnum}}</div>
                                    <div>社团</div>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
    </div>
</template>

<script>
    export default {
        name: 'Totalnum',
        data() {
            return{
                Membernum:'',
                Actionnum:'',
                Clubnum:'',
            }
        },
        methods:{
            getMember(){
                this.$axios.get('http://www.clubs.org/index.php/getAllMember')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        // let temp =[];
                        // ret.data.forEach((val)=>{
                        //     val.create_time=this.common.toDate(val.create_time);
                        //     temp.push(val);
                        // });
                        this.Membernum=ret.data.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            getAction(){
                this.$axios.get('http://www.clubs.org/index.php/getAllAction')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            if(val.ispass==1){
                                temp.push(val);
                            }  
                        });
                        this.Actionnum=temp.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            getClub(){
                 this.$axios.get('http://www.clubs.org/index.php/getAllClub')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let temp =[];
                        ret.data.forEach((val)=>{
                            if(val.ispass==1){
                                temp.push(val);
                            }  
                        });
                        this.Clubnum=temp.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            }
        },
        mounted(){
            this.getMember();
            this.getAction();
            this.getClub();
        }
    }  
</script>

<style scoped>
    .el-row {
        margin-bottom: 20px;
    }

    .grid-content {
        display: flex;
        align-items: center;
        height: 100px;
    }

    .grid-cont-right {
        flex: 1;
        text-align: center;
        font-size: 14px;
        color: #999;
    }

    .grid-num {
        font-size: 30px;
        font-weight: bold;
    }

    .grid-con-icon {
        font-size: 50px;
        width: 100px;
        height: 100px;
        text-align: center;
        line-height: 100px;
        color: #fff;
    }

    .grid-con-1 .grid-con-icon {
        background: rgb(45, 140, 240);
    }

    .grid-con-1 .grid-num {
        color: rgb(45, 140, 240);
    }

    .grid-con-2 .grid-con-icon {
        background: rgb(100, 213, 114);
    }

    .grid-con-2 .grid-num {
        color: rgb(45, 140, 240);
    }

    .grid-con-3 .grid-con-icon {
        background: rgb(242, 94, 67);
    }

    .grid-con-3 .grid-num {
        color: rgb(242, 94, 67);
    }

    .user-info {
        display: flex;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 2px solid #ccc;
        margin-bottom: 20px;
    }

    .user-avator {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }

    .user-info-cont {
        padding-left: 50px;
        flex: 1;
        font-size: 14px;
        color: #999;
    }

    .user-info-cont div:first-child {
        font-size: 30px;
        color: #222;
    }

    .user-info-list {
        font-size: 14px;
        color: #999;
        line-height: 25px;
    }

    .user-info-list span {
        margin-left: 70px;
    }

    .mgb20 {
        margin-top: 120px;
        margin-bottom: 20px;
        padding: 0 20px;
    }

    .todo-item {
        font-size: 14px;
    }

    .todo-item-del {
        text-decoration: line-through;
        color: #999;
    }

    .schart {
        width: 100%;
        height: 300px;
    }
</style>
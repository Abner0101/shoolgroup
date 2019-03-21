<template>
    <div>
        <div class="baseHead">
            <p>我的消息</p>
        </div>
        <div class="myWrite_con">
            <div class="myMsgCon">
                <div class="myMsgCon_pic"></div>
                <div class="myMsgCon_detail">
                    <a href="">xxx回复你:我觉得你说的不对</a>
                </div>
                <p class="myMsgCon_time">15:30:46</p>
            </div>
            <div class="myMsgCon">
                <div class="myMsgCon_pic"></div>
                <div class="myMsgCon_detail">
                    <a href="">xxx回复你:我觉得你说的不对</a>
                </div>
                <p class="myMsgCon_time">15:30:46</p>
            </div>
            <div class="myMsgCon">
                <div class="myMsgCon_pic"></div>
                <div class="myMsgCon_detail">
                    <a href="">xxx回复你:我觉得你说的不对</a>
                </div>
                <p class="myMsgCon_time">15:30:46</p>
            </div>
            <div class="myMsgCon">
                <div class="myMsgCon_pic"></div>
                <div class="myMsgCon_detail">
                    <a href="">xxx回复你:我觉得你说的不对</a>
                </div>
                <p class="myMsgCon_time">2018-3-27 15:30:46</p>
            </div>
        </div>
        <el-pagination
          background
          layout="prev, pager, next"
          :total="100"
          style="margin:25px 80px">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        name:'Mymessage',
        data() {
            return{}
        }
  }
</script>

<style scoped>
    .baseHead{
        width: 95%;
        height: 40px;
        background-color: #f2f2f2;
        border-radius: 10px;
        border: 1px solid #d7d7d7;
        margin: 15px 25px;

    }
    .baseHead p{
        font-size: 14px;
        color: #838586;
        text-indent: 40px;
        line-height: 40px;
    }
    .myWrite_con{
        width: 860px;
        height: 420px;
        border: 1px solid #e8e8e8;
        border-radius: 5px;
        margin-top: 30px;
        margin-left: 60px;
    }
    .myMsgCon{
        box-sizing: border-box;
        width: 100%;
        height: 36px;
        border-bottom: 1px solid #e8e8e8;
        padding-left: 24px;
        padding-right: 32px;
    }
    .myMsgCon:hover{
        background-color: #f8f8f8;
    }
    .myMsgCon:first-of-type{
        border-radius: 5px 5px 0 0;
    }
    .myMsgCon_pic{
        width: 20px;
        height: 20px;
        margin-top: 10px;
        background-color: #999;
        float: left;
    }
    .myMsgCon_pic img{
        width: 20px;
        height: 20px;
    }
    .myMsgCon_detail{
        width: 600px;
        height: 100%;
        line-height: 36px;
        float: left;
        margin-left: 15px;
        overflow: hidden;
    }
    .myMsgCon_detail a{
        color: #666;
    }
    .myMsgCon_time{
        float: right;
        line-height: 36px;
        color: #666;
    }
    .indexFooter{
        width: 100%;
        height: 40px;
        position: relative;
        margin-top: 14px;
    }
    .indexFooter_con{
        position: absolute;
        height: 40px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 10px #999;
        border-radius: 10px;
    }
    .indexFooter_con a{
        display: block;
        width: 40px;
        height: 40px;
        float: left;
        background-color: #fff;
        border-right: 1px dashed #cecece;
        font-size: 14px;
        color: #666;
        text-align: center;
        line-height: 45px;
    }
    .indexFooter_con a:first-of-type{
        border-radius: 10px 0 0 10px;
    }
    .indexFooter_con a:last-of-type{
        border-radius: 0 10px 10px 0;
        border-right: none;
    }
    .indexFooter_con a.on {
        background-color: #e43e20;
        border-right: none;
        color: #fff;
    } 
</style>
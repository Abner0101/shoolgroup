<template>
    <div>
        <v-header></v-header>
        <div class="indexMain">
            <div class="indexMain_left">
                <!-- 轮播信息 -->
                <div class="indexMain_left_slide">
                    <el-carousel indicator-position="outside">
                        <el-carousel-item v-for="item in 4" :key="item">
                            <h3>{{ item }}</h3>
                            <div class="slide-title"></div>
                        </el-carousel-item>
                    </el-carousel>
                </div>

                <div class="indexMain_left_btn">
                    <ul>
                        <li><a href="javascript:">社团动态</a></li>
                        <li><a href="javascript:">置顶</a></li>
                        <li><a href="javascript:" class="on">最新</a></li>
                    </ul>
                </div>

                <!-- 社团发布的信息 -->
                <div class="indexMain_left_con">
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>招新</span>
                                    <p>计算机社团招新啦！</p>
                                </div>
                            </a>
                            <div class="havePic">
                                <a href=""><div class="havePic_head"></div></a>
                            </div>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>花开花落</li>
                                    <li>1天前</li>
                                    <li>21</li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>比赛</span>
                                    <p>【建模社团】建模大赛比赛日程</p>
                                </div>
                            </a>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>帅到被人砍</li>
                                    <li>1天前</li>
                                    <li>21</li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>比赛</span>
                                    <p>【建模社团】建模大赛比赛日程</p>
                                </div>
                            </a>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>花开花落</li>
                                    <li>1天前</li>
                                    <li>21</li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>比赛</span>
                                    <p>【建模社团】建模大赛比赛日程</p>
                                </div>
                            </a>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>花开花落</li>
                                    <li>1天前</li>
                                    <li>21</li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>招新</span>
                                    <p>计算机社团招新啦！</p>
                                </div>
                            </a>
                            <div class="havePic">
                                <a href=""><div class="havePic_head"></div></a>
                            </div>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>花开花落</li>
                                    <li>1天前</li>
                                    <li>21</li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="indexFooter">
                    <div class="indexFooter_con">
                        <a href="javascript:"><</a>
                        <a href="" class="on">1</a>
                        <a href="">2</a>
                        <a href="">3</a>
                        <a href="javascript:">></a>
                    </div>
                </div>
            </div>

            <div class="indexMain_right">
                <div class="indexMain_rightCon">
                    <a href="" class="newMsg">创建社团</a>
                    <a href="" class="newMsg">加入社团</a>
                    <div class="pwfb">
                        <div class="pwfbHead">
                            社团福利
                        </div>
                        <div class="pwfbCon"></div>
                        <div class="pwfbFooter"></div>
                    </div>
                    <div class="indexSearch">
                        <input type="text" placeholder="请输入关键词"/>
                        <input type="submit" value="搜索"/>
                    </div>
                    <div class="indexPublic">
                        <div class="indexPublic_head">
                            本周热议
                        </div>
                        <div class="indexPublic_con">
                            <ul class="weekHot">
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                                <li><a href="">关注上海车牌竞拍方面的资讯</a><span>29</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="indexPublic">
                        <div class="indexPublic_head">
                            友情链接
                        </div>
                        <div class="indexPublic_con">
                            <ul class="indexLink">
                                <li><a href="">拍王淘宝链接</a></li>
                                <li><a href="">拍王网站</a></li>
                                <li><a href="">拍王助手</a></li>
                                <li><a href="">沪牌模拟</a></li>
                                <li><a href="">拍王合作咨询</a></li>
                                <li><a href="">快法务</a></li>
                                <li><a href="">国拍网</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="indexWxpublic">
                        <p>关注微信公众号</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <v-footer></v-footer>
    </div>
</template>

<script>
  import vHeader from './common/Homeheader.vue'
  import vFooter from './common/Homefooter.vue'
  export default {
    name:'Index',
    data() {
        return{}
    },
    methods: {

    },
    components: {
      vHeader,
      vFooter
    }
  }
</script>

<style scoped>
    .slide-title {
        width:100%;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        bottom: 0;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .el-carousel__item{
        height: 300px;
        border-radius: 10px;
    }
    .el-carousel__item h3 {
        color: #475669;
        font-size: 18px;
        opacity: 0.75;
        line-height: 300px;
        margin: 0;
    }
      
    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }
      
    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
    .indexMain{
        width: 1200px;
        margin: 0 auto;
        margin-top: 12px;
    }
    .indexMain_left{
        width: 785px;
        float: left;
    }
    .indexMain_right{
        float: right;
        width: 390px;
        position: relative;
    }
    .indexMain_left_slide{
        position: relative;
        width: 100%;
        height: 300px;
        border-radius: 10px;
        background-color: #fff;
        box-sizing: border-box;
        box-shadow: 0 0 10px #999;
    }
    .indexMain_left_btn{
        margin-top: 15px;
        width: 100%;
        height: 55px;
        border-radius: 10px;
        background-color: #fff;
        box-sizing: border-box;
        box-shadow: 0 0 10px #999;
    }
    .indexMain_left_btn ul{
        margin-left: 25px;
    }
    .indexMain_left_btn li{
        float: left;
        margin-right: 3%;
        line-height: 55px;
        font-size: 14px;
    }
    .indexMain_left_btn li:nth-of-type(1){
        font-weight: bold;
        letter-spacing: 2px;
        margin-right: 0;
        margin-right: 75%;
    }
    .indexMain_left_btn li a{
        color: #000;
    }
    .indexMain_left_btn li a.on{
        color: #3AA6C2;
    }
    .indexMain_left_con{
        width: 100%;
        box-sizing: border-box;
        padding: 0 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 15px;
        background-color: #fff;
    }
    .indexCon_msg{
        box-sizing: border-box;
        padding-bottom: 15px;
        width: 100%;
        border-bottom: 1px dashed #f2f2f2;
    }
    .indexCon_msg:last-of-type{
        border-bottom: none;
    }
    .indexCon_msg_pic{
        width: 46px;
        height: 46px;
        float: left;
        background-color: #999;
        margin-left: 11px;
        margin-top: 14px;
        overflow: hidden;
    }
    .indexCon_msg_pic img{
        width: 46px;
        height: 46px;
    }
    .indexCon_msg_detail{
        width: 680px;
        /*height: 46px;*/
        overflow: hidden;
        float: left;
       margin-top: 14px;
        margin-left: 19px;
    }
    .indexCon_msg_detail_tittle{
        width: 100%;
        height: 28px;
        overflow: hidden;
    }
    .indexCon_msg_detail_tittle span{
        display: block;
        float: left;
        padding: 0 6px;
        border: 1px solid #409EFF;
        border-radius: 5px;
        color:#409EFF ;
        margin-right: 10px;
        margin-top: 2px;
    }
    .indexCon_msg_detail_tittle p{
        float: left;
        font-size: 14px;
        color: #333;
    }
    .indexCon_msg_detail_tittle p:hover{
        color: #e43e20;
        text-decoration: underline;
    }
    .havePic{
        width: 100%;
        height: 110px;
        margin-bottom: 10px;
    }
    .havePic_head{
        width: 190px;
        height: 110px;
        background-color: #999;
        overflow: hidden;
    }
    .havePic_head img{
        width: 190px;
        height: 110px;
    }
    .indexCon_msg_detail_other{
        width: 100%;
        height: 18px;
    }
    .indexCon_msg_detail_other li{
        float: left;
        margin-right: 25px;
        color: #666;
        height: 18px;
        line-height: 18px;
    }
    .indexCon_msg_detail_other li:nth-child(3){
        text-indent: 25px;
        background: url("../../assets/images/indexEye.png") no-repeat 0 center;
    }
    .indexCon_msg_detail_other li:nth-child(4){
        float: right;
        margin-right: 10px;
        text-indent: 20px;
        background: url("../../assets/images/replayIcon.png") no-repeat 0 center;
    }
    .indexCon_msg_replay{
        width: 70px;
        height: 46px;
        float: right;
        margin-top: 14px;
        overflow: hidden;
        background: url("../../assets/images/replayIcon.png") no-repeat 0 30px;
        position: relative;
    }
    .indexCon_msg_replay span{
        position: absolute;
        bottom: 3px;
        left: 20px;
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
        background-color: #409EFF;
        border-right: none;
        color: #fff;
    }
    /*ÓÒ±ß*/
    .newMsg{
        display: block;
        font-size: 14px;
        width: 100%;
        height: 40px;
        border-radius: 10px;
        color: #fff;
        text-align: center;
        line-height: 40px;
        letter-spacing: 1px;
        background-color: #409EFF;
        margin-top: 10px;
    }
    .pwfb{
        width: 100%;
        height: 385px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 14px;
        background-color: #fff;
    }
    .pwfbHead{
        box-sizing: border-box;
        width: 100%;
        height: 60px;
        background-color: #f8f8f8;
        border-radius: 10px;
        border-bottom: 1px solid #d8d8d8;
        font-size: 14px;
        text-indent: 20px;
        line-height: 60px;
    }
    .pwfbCon{
        width: 100%;
        height: 265px;
    }
    .pwfbFooter{
        width: 100%;
        height: 60px;
        border-radius: 0 0 10px 10px;
        background-color: #f8f8f8;
    }
    .indexSearch{
        width: 100%;
        height: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 14px;
        background-color: #fff;
    }
    .indexSearch input[type=text]{
        width: 290px;
        height: 40px;
        text-indent: 20px;
        border: none;
        border-radius: 10px 0 0 10px;
        float: left;
    }
    .indexSearch input[type=submit]{
        width: 100px;
        height: 40px;
        color: #fff;
        text-align: center;
        line-height: 40px;
        border-radius: 0 10px 10px 0;
        border: none;
        float: left;
        background-color: #409EFF;
        font-size: 14px;
    }
    .indexPublic{
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 14px;
        background-color: #fff;
    }
    .indexPublic_head{
        width: 100%;
        height: 60px;
        background-color: #f8f8f8;
        border-radius: 10px;
        border-bottom: 1px solid #d8d8d8;
        font-size: 14px;
        text-indent: 20px;
        line-height: 60px;
    }
    .indexPublic_con{
        box-sizing: border-box;
        padding: 23px 20px;
    }
    .weekHot li{
        width: 100%;
        height: 20px;
        font-size: 14px;
        margin-bottom: 8px;
        overflow: hidden;
    }
    .weekHot li a{
        color: #666;
        line-height: 20px;
        float: left;
    }
    .weekHot li span{
        display: block;
        width: 60px;
        height: 20px;
        float: left;
        margin-left: 20px;
        line-height: 20px;
        text-indent: 20px;
        background: url("../../assets/images/replayIcon.png") no-repeat 0 center;
    }
    .indexLink li{
        width: 100%;
        height: 20px;
        text-indent: 15px;
        line-height: 20px;
        margin-bottom: 8px;
        font-size: 14px;
        background: url("../../assets/images/indexLink_icon.png") no-repeat 0 center;
    }
    .indexLink li a{
        color: #666;
    }
    .indexWxpublic{
        width: 100%;
        height: 290px;
        margin-top: 14px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        background:#fff url("../../assets/images/wxPublic.png") no-repeat center 30px;
        overflow: hidden;
        font-size: 14px;
        color: #666;
        text-align: center;
    }
    .indexWxpublic p{
        margin-top: 250px;
    }
    .publicFooter{
        margin-top: 55px;
        width: 100%;
        height: 80px;
        text-align: center;
        font-size: 14px;
        color: #666;
        line-height: 80px;
        background: url("../../assets/images/footerBg.png") no-repeat center 0;
    }
    /*Ìû×ÓÄÚÈÝ²¿·Ö*/
    .tzCon{
        width: 100%;
        box-sizing: border-box;
        padding: 27px 16px 0 16px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        background-color: #fff;
    }
    .tzCon_head{
        width: 100%;
    }
    .tzCon_head_left{
        width: 45px;
        height: 45px;
        background-color: #999;
        float: left;
    }
    .tzCon_head_left img{
        width: 45px;
        height: 45px;
    }
    .tzCon_head_right{
        width: 680px;
        float: right;
    }
    .tzCon_head_right h1{
        font-size: 24px;
    }
    .tzCon_head_right li{
        float: left;
        height: 20px;
        line-height: 20px;
        margin-right: 25px;
        color: #666;
    }
    .tzCon_head_right li:last-of-type{
        text-indent: 20px;
        background: url("../../assets/images/indexEye.png") no-repeat 0 center;
    }
    .tzCon_con{
        margin-top: 10px;
        width: 100%;
        box-sizing: border-box;
        padding:15px 7px;
        background: url("../../assets/images/tzBox_bg.png") no-repeat center 0;
    }
    .tzCon_foot{
        width: 100%;
        height: 95px;
        box-sizing: border-box;
        padding-top: 18px;
    }
    .tzCollect{
        width: 135px;
        height: 46px;
        border-radius: 5px;
        box-shadow: 0 0 10px #999;
        margin: 0 auto;
    }
    .tzCollect_left{
        width: 90px;
        height: 46px;
        float: left;
        font-size: 14px;
        color: #666;
        text-align: center;
        line-height: 46px;
        cursor: pointer;
        background: url("../../assets/images/tzCollect.png") no-repeat 15px center;
    }
    .tzCollect_left.on{
        background: url("../../assets/images/tzCollect_hover.png") no-repeat 15px center;
    }
    .newPending{
        width: 100%;
        box-sizing: border-box;
        padding: 36px 6px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        background-color: #fff;
        margin-top: 14px;
    }
    .newPending_head{
        width: 100%;
        height: 40px;
        position: relative;
    }
    .tzHeng{
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #f2f2f2;
        position: relative;
        top: 30px;
    }
    .newPending_head_tittle{
        box-sizing: border-box;
        padding: 0 20px;
        height: 40px;
        font-size: 24px;
        color: #333;
        text-align: center;
        line-height: 50px;
        background-color: #fff;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }
    .newPending_son{
        box-sizing: border-box;
        width: 100%;
        padding: 15px 0 12px 0;
        border-bottom: 1px dashed #f2f2f2;
    }
    .pendPic{
        width: 46px;
        height: 46px;
        background-color: #999;
        overflow: hidden;
        float: left;
        margin-left: 15px;
    }
    .pendDetail{
        width: 695px;
        float: right;
    }
    .pendDetail_head{
        width: 100%;
        height: 25px;
    }
    .pendDetail_head p{
        color: #333;
        font-size: 14px;
        float: left;
    }
    .pendDetail_head p span{
        font-size: 12px;
        color: #999;
       margin-left: 10px;
    }
    .pendDetail_head i{
        float: right;
        font-style: normal;
        color: #999;
        margin-right: 25px;
    }
    .pendDetail_con{
        width: 675px;
    }
    .pendDetail_con p{
        font-size: 14px;
    }
    .pendDetail_btn{
        width: 100%;
        height: 30px;
    }
    .pendDetail_btn li{
        float: left;
        height: 30px;
        margin-right: 20px;
        line-height: 30px;
        text-indent: 17px;
        color: #999;
        cursor: pointer;
    }
    .pendDetail_action{
        width: 615px;
        height: 80px;
        margin-top: 12px;
        display: none;
    }
    .pendDetail_action input[type=text]{
        width: 100%;
        height: 35px;
        border: none;
        border-radius: 2px;
        box-shadow: 0 0 10px #999;
        background-color: #f2f2f2;
        text-indent: 10px;
    }
    .pendDetail_action button{
        width: 68px;
        height: 36px;
        border-radius: 2px;
        border: none;
        float: right;
        margin-top: 10px;
        margin-left: 10px;
        font-size: 14px;
    }
    .pendDetail_action button:first-of-type{
        background-color: #e43e20;
        color: #fff;
    }
    .pendDetail_action button:last-of-type{
        background-color: #f2f2f2;
        color: #333;
    }
    .pendDetail_btn li:nth-child(1){
        background: url("../../assets/images/zan.png") no-repeat 0 center;
    }
    .replayBtn{
        background: url("../../assets/images/replayL.png") no-repeat 0 center;
    }
    .delateBtn{
        background: url("../../assets/images/delate.png") no-repeat 0 center;
    }
    .pendDetail_btn li.on{
        background: url("../../assets/images/zan_hover.png") no-repeat 0 center;
        color: #e43e20;
    }
    .pendDetail_replayCon{
        width: 615px;
        min-height: 30px;
        box-sizing: border-box;
        padding-left: 10px;
        background-color: #f2f2f2;
        border-radius: 2px;
        box-shadow: 0 0 10px #999;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .pendDetail_replayCon p{
        font-size: 14px;
        color: #333;
        line-height: 30px;
    }
    .pendPic img{
        width: 46px;
        height: 46px;
    }
    .tzCollect_right{
        margin-top: 3px;
        width: 45px;
        height: 40px;
        box-sizing: border-box;
        border-left: 1px dashed #cecece;
        float: left;
        font-size: 14px;
        line-height: 40px;
        text-align: center;
        color: #666;
    }
    .writePending{
        box-sizing: border-box;
        width: 100%;
        height: 155px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 14px;
        padding-top: 15px;
    }
    .writePending_con{
        margin-top: 25px;
        width: 750px;
        height: 45px;
        margin-left: 15px;
    }
    .writePending_con input[type=text]{
        width: 645px;
        height: 45px;
        background-color: #f2f2f2;
        border: none;
        box-shadow: 0 0 10px #f2f2f2;
        text-indent: 20px;
        float: left;
    }
    .writePending_con input[type=submit]{
        width: 90px;
        height: 45px;
        float: right;
        border: none;
        background-color: #e43e20;
        color: #fff;
        font-size: 14px;
    }
    .myMsg{
        width: 100%;
        height: 320px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin-top: 14px;
        background-color: #fff;
    }
    .myMsg_con{
        width: 100%;
        height: 260px;
        box-sizing: border-box;
        padding-top: 80px;
    }
    .myMsg_conPic{
        width: 95px;
        height: 95px;
        background-color: #999;
        margin: 0 auto;
    }
    .myMsg_conPic img{
        width: 95px;
        height: 95px;
    }
    .myMsg_con p{
        text-align: center;
        font-size: 18px;
        color: #666;
        letter-spacing: 1px;
        line-height: 50px;
    }
    .myMsg_footer{
        width: 100%;
        height: 60px;
        background-color: #f8f8f8;
        border-radius: 0 0 10px 10px;
    }
    .myMsg_footer ul{
        margin-left: 45px;
    }
    .myMsg_footer li{
        width: 100px;
        height: 60px;
        float: left;
        font-size: 14px;
        text-align: center;
    }
    .myMsg_footer li a{
        color: #666;
    }
    .myMsg_footer li a p:first-of-type{
        margin-top: 15px;
    }
</style>
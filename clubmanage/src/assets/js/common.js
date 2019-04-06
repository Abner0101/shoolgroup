
import bus from '../../components/common/bus.js'
export default{
    toastMsg(msg,type){     //信息提示
        switch (type){
            case 'normal':
                bus.$message({
                    message:msg,
                    duration:1500
                })
                break
            case 'success':
                bus.$message({
                    message:msg,
                    duration:1500,
                    type:'success'
                })
                break
            case 'warning':
                bus.$message({
                    message:msg,
                    duration:1500,
                    type:'warning'
                })
                break
            case 'error':
                bus.$message({
                    message:msg,
                    duration:1500,
                    type:'error'
                })
                break
        }
    },
    toDate(date){
        let a = new Date(date*1000);
        let YY = a.getFullYear();
        let MM = a.getMonth()+1;
        let DD = a.getDate();
        let time= YY + "-" + MM + "-" + DD;
        return time;
    }
}
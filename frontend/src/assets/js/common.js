import bus from './bus.js'
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
	IsPC() {                //判断是否是PC端
        let userAgentInfo = navigator.userAgent;
        let Agents = ["Android", "iPhone","SymbianOS", "Windows Phone","iPad", "iPod"];
        let flag = true;
        for (let i = 0; i < Agents.length; i++) {
            if (userAgentInfo.indexOf(Agents[i]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
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
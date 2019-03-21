export default{
	methods:{
		apiPost(url,data){
			return new Promise((resolve,reject) => {
				this.$http.post(url,data).then((response) => {
					resolve(response.data)
				}).catch((response) => {
					reject(response)
					this.common.toastMsg('请求超时，请检查网络','warning')
				})
			})
		},

		apiJsonp(url,data){
			return new Promise((resolve,reject) => {
				this.$http.jsonp(url,data).then((response) => {
					resolve(response.data)
				}).catch((response) => {
					reject(response)
					this.common.toastMsg('请求超时，请检查网络','warning')
				})
			})
		},
		
		apiGet(url,data){
			return new Promise((resolve,reject) =>{
				this.$http.get(url,data).then((response) => {
					resolve(response.data)
				}).catch((response) => {
					reject(response)
					this.common.toastMsg('请求超时，请检查网络','warning')
				})
			})
		},

		handleError(res){
			sessionStorage.removeItem('m_number');
			sessionStorage.removeItem('m_id');
			sessionStorage.removeItem('m_name');
			sessionStorage.removeItem('sessionId');
			sessionStorage.removeItem('authKey');
			this.common.toastMsg('登录失效','warning');
			// let that=this;
			setTimeout(()=>{
                let routeData = this.$router.resolve({
		            name: "Login"
		        });
		        window.open(routeData.href, '_self');
            },1000); 
	        
		}
			
	}
}
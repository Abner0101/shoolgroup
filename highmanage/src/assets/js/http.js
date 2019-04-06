export default{
    methods:{
        handleError(res){
            localStorage.removeItem('id')
            localStorage.removeItem('username');
            localStorage.removeItem('m_sessionId');
            localStorage.removeItem('m_authKey');
            this.common.toastMsg('登录失效','warning');
            // let that=this;
            setTimeout(()=>{
                // window.location.reload();
                this.$router.push('/login');
            },1500); 
        
        },
    }
}
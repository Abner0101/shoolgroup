export default{
    methods:{
        handleError(res){
            localStorage.removeItem('m_id')
            localStorage.removeItem('m_name');
            localStorage.removeItem('c_sessionId');
            localStorage.removeItem('c_authKey');
            localStorage.removeItem('departId');
            this.common.toastMsg('登录失效','warning');
            // let that=this;
            setTimeout(()=>{
                // window.location.reload();
                this.$router.push('/login');
            },1500); 
            
        },
    }
}
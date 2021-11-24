import Api from './Api'

export default {
    register(form){
        return Api().post('/admin/register', form)
    },

    login(form){
        return Api().post('/admin/login', form)
    },

    logout(){
        return Api().post('/admin/logout')
    },

    auth(){
        return Api().get('/user')
    }
        
}
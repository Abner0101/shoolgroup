import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/',
            component: resolve => require(['../components/common/Home.vue'], resolve),
            meta: { title: '自述文件' },
            children:[
                {
                    path: '/dashboard',
                    component: resolve => require(['../components/page/DateCenter.vue'], resolve),
                    meta: { title: '系统首页' }
                },
                {
                    path: '/manager',
                    component: resolve => require(['../components/page/Manager.vue'], resolve),
                    meta: { title: '权限管理' }
                },
                {
                    path: '/memberlist',
                    component: resolve => require(['../components/page/Memberlist.vue'], resolve),
                    meta: { title: '会员管理' }
                },
                {
                    path: 'commentlist',
                    component: resolve => require(['../components/page/Commentlist.vue'], resolve),
                    meta: { title: '评论列表' }
                },
                {
                    path: '/clubcheck',
                    component: resolve => require(['../components/page/Clubcheck.vue'], resolve),
                    meta: { title: '社团审核' }
                },
                {
                    path: '/clubtable',
                    component: resolve => require(['../components/page/Clubtable.vue'], resolve),
                    meta: { title: '社团列表' }
                },
                {
                    path: '/equipcheck',
                    component: resolve => require(['../components/page/Equipcheck.vue'], resolve),
                    meta: { title: '申请审核' }
                },
                {
                    path: '/equiplist',
                    component: resolve => require(['../components/page/Equiplist.vue'], resolve),
                    meta: { title: '申请列表' }
                },
                {
                    path: '/actioncheck',
                    component: resolve => require(['../components/page/Actioncheck.vue'], resolve),
                    meta: { title: '活动审核' }
                },
                {
                    path: 'actionlist',
                    component: resolve => require(['../components/page/Actionlist.vue'], resolve),
                    meta: { title: '活动列表' }
                },

                {
                    path: '/icon',
                    component: resolve => require(['../components/page/Icon.vue'], resolve),
                    meta: { title: '自定义图标' }
                },
                {
                    path: '/table',
                    component: resolve => require(['../components/page/BaseTable.vue'], resolve),
                    meta: { title: '基础表格' }
                },
                {
                    path: '/tabs',
                    component: resolve => require(['../components/page/Tabs.vue'], resolve),
                    meta: { title: 'tab选项卡' }
                },
                {
                    path: '/form',
                    component: resolve => require(['../components/page/BaseForm.vue'], resolve),
                    meta: { title: '基本表单' }
                },
                {
                    // 富文本编辑器组件
                    path: '/editor',
                    component: resolve => require(['../components/page/VueEditor.vue'], resolve),
                    meta: { title: '富文本编辑器' }
                },
                {
                    // markdown组件
                    path: '/markdown',
                    component: resolve => require(['../components/page/Markdown.vue'], resolve),
                    meta: { title: 'markdown编辑器' }    
                },
                {
                    // 图片上传组件
                    path: '/upload',
                    component: resolve => require(['../components/page/Upload.vue'], resolve),
                    meta: { title: '文件上传' }   
                },
                {
                    // vue-schart组件
                    path: '/charts',
                    component: resolve => require(['../components/page/BaseCharts.vue'], resolve),
                    meta: { title: 'schart图表' }
                },
                {
                    // 拖拽列表组件
                    path: '/drag',
                    component: resolve => require(['../components/page/DragList.vue'], resolve),
                    meta: { title: '拖拽列表' }
                },
                {
                    // 拖拽Dialog组件
                    path: '/dialog',
                    component: resolve => require(['../components/page/DragDialog.vue'], resolve),
                    meta: { title: '拖拽弹框' }
                },
                {
                    // 权限页面
                    path: '/permission',
                    component: resolve => require(['../components/page/Permission.vue'], resolve),
                    meta: { title: '权限测试', permission: true }
                },
                {
                    path: '/404',
                    component: resolve => require(['../components/page/404.vue'], resolve),
                    meta: { title: '404' }
                },
                {
                    path: '/403',
                    component: resolve => require(['../components/page/403.vue'], resolve),
                    meta: { title: '403' }
                }
            ]
        },
        {
            path: '/login',
            component: resolve => require(['../components/page/Login.vue'], resolve)
        },
        {
            path: '*',
            redirect: '/404'
        }
    ]
})

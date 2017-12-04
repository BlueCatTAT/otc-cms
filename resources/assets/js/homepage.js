require('./bootstrap');

window.Vue = require('vue');
const Paginate = require('vuejs-paginate');
Vue.component('paginate', Paginate);

const homepage = new Vue({
    el: '#homepage',
    created: function() {
        this.getCommissionList(1);
    },
    data: {
        commissionList: [],
        cryptoType: window.CRYPTO_TYPE,
    },
    methods: {
        getCommissionList: function(page) {
            $.get('/commissions/?type='+this.cryptoType, { page: page }, result => {
                if (undefined === result.error) {
                    this.commissionList = result;
                }
            });
        }
    }
});

require('./bootstrap');

window.Vue = require('vue');

const homepage = new Vue({
    el: '#homepage',
    created: function() {
        this.getCommissionList(1);
    },
    data: {
        commissionList: [],
    },
    methods: {
        getCommissionList: function(page) {
            $.get('/commissions', { page: page }, result => {
                if (undefined === result.error) {
                    this.commissionList = result;
                }
            });
        }
    }
});

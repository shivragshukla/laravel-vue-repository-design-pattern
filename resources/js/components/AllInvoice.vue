<template>
    <div>
        <h2 class="text-left">Invoices List</h2>
        <h6>There are {{invoices.length}} total invoices</h6>
         <router-link to= "/create" class="btn btn-info float-right" >Create Invoice </router-link>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Due date</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="invoice in invoices" :key="invoice.id">
                    <td>{{invoice.invoice_num}}</td>
                    <td>{{invoice.payment_due | dateFormat}}</td>
                    <td>{{invoice.client_name}}</td>
                    <td>{{invoice.total}}</td>
                    <td>{{invoice.status}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'view', params: {id: invoice.id}}" class="btn btn-dark mr-2">View</router-link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                invoices:[]
            }
        },
        created(){
            this.getInvoices();
        },
        methods:{
            async getInvoices () {
             let res =  await this.$http({ url: `invoices`,  method: 'GET'});
             this.invoices = res.data.data || []; 
            },
        }
    } 
</script>
<template>
    <div>
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                  Status 
                                  <label class="badge badge-warning p-2 ml-5">
                                    {{invoice.status}}
                                  </label>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col">
                                    <div class="btn-group" role="group">
                                        <router-link :to="{name: 'edit', params: {id: invoice.id}}" class="btn btn-dark mr-2">Edit</router-link>
                                        <button class="btn btn-danger mr-2" @click="deleteInvoice(invoice.id)">Delete</button>
                                        <button class="btn btn-info" @click="paidInvoice(invoice.id)" v-if="invoice.status !== 'paid'">Mark as Paid</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6>
                                        #{{invoice.invoice_num}}
                                    </h6>
                                </div>
                                <div class="col"></div>
                                <div class="col">
                                    <h6>{{ clientAddress }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h6>Invoice Date</h6>
                                    <h6> {{ invoice.invoice_date | dateFormat }}</h6>
                                </div>
                                <div class="col">
                                    <h6>Bill To</h6>
                                    <h6>{{ senderAddress }}</h6>
                                </div>
                                <div class="col">
                                    <h6>Sent To</h6>
                                    <h6>{{ invoice.client_email }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h6>Payment Due</h6>
                                    <h6>  {{invoice.payment_due | dateFormat }}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in invoice.items" :key="item.id">
                                                <td>{{item.name}}</td>
                                                <td>{{item.quantity}}</td>
                                                <td>{{item.price}}</td>
                                                <td>{{item.total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row bg-dark p-2 text-white">
                                <div class="col">
                                    <h6>Amount Due</h6>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col">{{invoice.total}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                invoice:{}
            }
        },
        created() {
            this.getInvoice();
        },
        computed: {
            invoiceDate() {
                return this.invoice.invoice_date?.diffForHumans;
            },
            paymentDue() {
                return this.invoice.payment_due?.diffForHumans;
            },
            clientAddress() {
                if (this.invoice.clientAddress) {
                    return `
                        ${this.invoice.clientAddress.street},
                        ${this.invoice.clientAddress.city},
                        ${this.invoice.clientAddress.postcode},
                        ${this.invoice.clientAddress.country}
                        `;
                }
                return null;
            },
            senderAddress() {
                if (this.invoice.senderAddress) {
                    return `
                        ${this.invoice.senderAddress.street},
                        ${this.invoice.senderAddress.city},
                        ${this.invoice.senderAddress.postcode},
                        ${this.invoice.senderAddress.country}
                        `;
                }
                return null;
            },
        },
        methods:{
            paidInvoice(id){
                this.axios.post(`invoices-paid/${id}`).then(response => {
                    Swal.fire('Paid!', 'Invoice has been paid.', 'success')
                    this.$router.push('/');
                });
            },
            deleteInvoice (id) {
                var subtitile = `Are you sure, you want to delete invoice #${this.invoice.invoice_num} This action cannot be undone.`
                Swal.fire({
                    title: 'Confirm Deletion?',
                    text: subtitile,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete(`invoices/${id}`).then(({data})=>{
                            Swal.fire('Deleted!', 'Invoice has been deleted.', 'success')
                            this.$router.push('/');
                        }).catch(({data})=>{
                            Swal.fire('Failed!', 'Something went wrong.', 'warning')
                        });
                    }
                })
            },
            async getInvoice() {
                await this.axios.get(`invoices/${this.$route.params.id}`).then((res)=> {
                    this.invoice = res.data.data;
                });
            }
        }
    }
</script>
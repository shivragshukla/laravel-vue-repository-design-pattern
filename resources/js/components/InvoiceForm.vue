<template>
    <div>
        <h3 class="text-left">New Invoice</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                            <!-- Alert -->
                            <alert-error :form="form"></alert-error>

                            <h5>Bill From</h5>

                            <div class="form-group">
                                <label>Street Address</label>
                                <input v-model="form.senderAddress.street" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('senderAddress.street') }">
                                <has-error :form="form" field="senderAddress.street"></has-error>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label>City</label>
                                        <input v-model="form.senderAddress.city" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('senderAddress.city') }">
                                        <has-error :form="form" field="senderAddress.city"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Post Code</label>
                                        <input v-model="form.senderAddress.postcode" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('senderAddress.postcode') }">
                                        <has-error :form="form" field="senderAddress.postcode"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Country</label>
                                        <input v-model="form.senderAddress.country" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('senderAddress.country') }">
                                        <has-error :form="form" field="senderAddress.country"></has-error>
                                    </div>
                                </div>
                            </div>

                            <h5>Bill To</h5>

                            <div class="form-group">
                                <label>Client's Name</label>
                                <input v-model="form.client_name" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('client_name') }">
                                <has-error :form="form" field="client_name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Client's Email</label>
                                <input v-model="form.client_email" type="email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('client_email') }"autocomplete="off">
                                <has-error :form="form" field="client_email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Street Address</label>
                                <input v-model="form.clientAddress.street" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('clientAddress.street') }">
                                <has-error :form="form" field="clientAddress.street"></has-error>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>City</label>
                                        <input v-model="form.clientAddress.city" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('clientAddress.city') }">
                                        <has-error :form="form" field="clientAddress.city"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Post Code</label>
                                        <input v-model="form.clientAddress.postcode" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('clientAddress.postcode') }">
                                        <has-error :form="form" field="clientAddress.postcode"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Country</label>
                                        <input v-model="form.clientAddress.country" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('clientAddress.country') }">
                                        <has-error :form="form" field="clientAddress.country"></has-error>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Invoice Date</label>
                                        <input v-model="form.invoice_date" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('invoice_date') }" placeholder="YYYY-MM-DD">
                                        <has-error :form="form" field="invoice_date"></has-error>
                                    </div>
                                    
                                    <div class="col">
                                        <label>Payment Terms</label>
                                        <input v-model="form.payment_terms" type="number" min="1"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('payment_terms') }">
                                        <has-error :form="form" field="payment_terms"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Project Description</label>
                                <input v-model="form.description" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"autocomplete="off">
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <h5>Item List</h5>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-bordered">
                                            <thead class="text text-success">
                                                <tr>                            
                                                    <th>Item Name</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr v-for='(item, index) in form.items'>            
                                                    <td>
                                                        <input 
                                                            v-model="item.name"
                                                            class="form-control"
                                                            :class="{ 'is-invalid': form.errors.has(`items.${index}.name`) }"
                                                            type="text" 
                                                        />
                                                        <has-error :form="form" :field="`items.${index}.name`"></has-error>
                                                    </td>
                                                    <td>
                                                        <input 
                                                            v-model="item.quantity"
                                                            class="form-control"
                                                            :class="{ 'is-invalid': form.errors.has(`items.${index}.quantity`) }"
                                                            type="number"
                                                            min="1" 
                                                        />
                                                        <has-error :form="form" :field="`items.${index}.quantity`"></has-error>
                                                    </td>
                                                    <td>
                                                        <input 
                                                            v-model="item.price"
                                                            class="form-control"
                                                            :class="{ 'is-invalid': form.errors.has(`items.${index}.price`) }"
                                                            type="number"
                                                            min="1" 
                                                        />
                                                        <has-error :form="form" :field="`items.${index}.price`"></has-error>
                                                    </td>
                                                    <td> {{item.quantity * item.price}}</td>
                                                    <td>
                                                        <b-icon 
                                                            icon="trash" 
                                                            @click="deleteRow(index)" 
                                                            v-if="form.items.length > 1" 
                                                            style="font-size:25px;color:red;cursor:pointer"></b-icon>
                                                    </td>
                                                </tr>                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-dark " @click="addRow"> + Add new Item</button>
                                    </div>
                                </div>
                            </div>

                            <div v-if="form.status !== 'paid'">
                                <div class="form-group" v-if="editMode">
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col">
                                            <button type="button" class="btn btn-dark" >Cancel</button>
                                            <button type="button" class="btn btn-info" @click="updateInvoice">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" v-else>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-light" >Discard</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-dark mr-2" @click="draftInvoice">Save as Draft</button>
                                            <button type="button" class="btn btn-info" @click="pendingInvoice">Save & Send</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
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
                editMode: Boolean(this.$route.params.id),
                baseUrl: process.env.MIX_APP_URL,
                form: new Form({
                    id: '',
                    client_name: '',
                    client_email: '',
                    senderAddress: {
                        id: '',
                        street: '',
                        city: '',
                        postcode: '',
                        country: ''
                    },
                    clientAddress: {
                        id: '',
                        street: '',
                        city: '',
                        postcode: '',
                        country: ''
                    },
                    items: [],
                    status: '',
                    payment_terms: '',
                    invoice_date: '',
                    description: '',
                }),
            }
        },
        created(){
            if (this.$route.params.id) {
                this.getInvoice();
            }
            else {
                this.addForm();
            }
        },
        methods:{
            addForm () {
                this.form.reset();
                this.form.clear();
                this.editMode = false;
            },
            editForm (data) {
                // Make a request for a get Users 
                this.form.reset();
                this.form.clear();
                this.form.fill(data);
                this.editMode = true;
            },
            addRow() {      
               this.form.items.push({name:'', quantity:'', price:''})
            },
            deleteRow(index){    
                this.form.items.splice(index,1);             
            },
            draftInvoice() {
                this.form.status = 'draft';
                this.saveInvoice();
            },
            pendingInvoice() {
                this.form.status = 'pending';
                this.saveInvoice();
            },
            saveInvoice() {
                this.form.post(this.baseUrl+'/api/invoices')
                .then(({ data }) => { 
                    Toast.fire({ icon: 'success', title: 'Invoice created successfully' });
                    this.$router.push('/');
                })
                .catch((error)=>{
                    Swal.fire('Failed!', 'Something went wrong.', 'warning');
                });
            },
            updateInvoice() {
                this.form.status = 'pending';
                var URL = this.baseUrl+'/api/invoices/' + this.form.id; 
                this.form.put(URL)
                .then(({ data }) => { 
                    Toast.fire({ icon: 'success', title: 'Invoice updated successfully' });
                    this.$router.push('/');
                })
                .catch((error)=>{
                    Swal.fire('Failed!', 'Something went wrong.', 'warning');
                });
            },
            async getInvoice() {
                await this.axios.get(`invoices/${this.$route.params.id}`).then((res)=> {
                    this.editForm(res.data.data)
                });
            }

        }
    } 
</script>
import AllInvoice from './components/AllInvoice.vue';
import InvoiceForm from './components/InvoiceForm.vue';
import ViewInvoice from './components/ViewInvoice.vue';

export const routes = [{
        name: 'home',
        path: '/',
        component: AllInvoice
    },
    {
        name: 'create',
        path: '/create',
        component: InvoiceForm
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: InvoiceForm
    },
    {
        name: 'view',
        path: '/view/:id',
        component: ViewInvoice
    },
];

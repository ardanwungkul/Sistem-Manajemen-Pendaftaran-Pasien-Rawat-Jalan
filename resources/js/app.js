import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/dataTables.dataTables.min.css";
import jquery from "jquery";
import select2 from "select2";
import "/node_modules/select2/dist/css/select2.css";
import "datatables.net-responsive-dt";
import "datatables.net-responsive-dt/css/responsive.dataTables.min.css";

window.$ = jquery;
window.Alpine = Alpine;

Alpine.start();
select2();

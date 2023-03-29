<?php

namespace App\Http\Controllers;

use App\Models\CalenderPenagihan;
use App\Models\LaporanPekerjaan;
use App\Models\PreOrder;
use App\Models\Quotation;
use App\Models\SupplierOrder;
use App\Models\User;
use Illuminate\Http\Request;

class HelperController extends Controller
{

    public static function sidebarControll(){
        return collect([
            collect([
                'nama' => 'Dashboard',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                        fill="currentColor" />
                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                        fill="currentColor" />
                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                        fill="currentColor" />
                </svg>',
                'role' => ['Super Admin', 'Manager', 'Worker'],
                'active' => 'dashboard',
                'route' => 'dashboard'
            ]),
            collect([
                'nama' => 'Quotation',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                            fill="currentColor" />
                    </svg>',
                'role' => ['Super Admin', 'Manager'],
                'active' => 'quotation',
                'route' => 'quotation'
            ]),
            collect([
                'nama' => 'Purchase Order',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.0077 19.2901L12.9293 17.5311C12.3487 17.1993 11.6407 17.1796 11.0426 17.4787L6.89443 19.5528C5.56462 20.2177 4 19.2507 4 17.7639V5C4 3.89543 4.89543 3 6 3H17C18.1046 3 19 3.89543 19 5V17.5536C19 19.0893 17.341 20.052 16.0077 19.2901Z" fill="currentColor"/>
                        </svg>',
                'role' => ['Super Admin', 'Manager'],
                'active' => 'purchase-order',
                'route' => null,
                'children' => collect([
                    collect([
                        'nama' => 'PO Masuk',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'pre-order',
                        'route' => 'pre-order'
                    ]),
                    collect([
                        'nama' => 'PO Keluar',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'supplier-order',
                        'route' => 'supplier.order'
                    ]),
                    collect([
                        'nama' => 'PO Masuk-Done',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'done-pre-order',
                        'route' => 'pre-order.done'
                    ]),
                ])
            ]),
            // collect([
            //     'nama' => 'Supplier Order',
            //     'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            //             <path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="currentColor"/>
            //             <path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="currentColor"/>
            //             <path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="currentColor"/>
            //             <path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="currentColor"/>
            //             </svg>',
            //     'role' => ['Super Admin', 'Manager', 'Admin Gudang'],
            //     'active' => 'supplier-order',
            //     'route' => 'supplier.order'
            // ]),
            collect([
                'nama' => 'Management Tugas',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                fill="currentColor" />
                            <path
                                d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                fill="currentColor" />
                            <path
                                d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                fill="currentColor" />
                        </svg>',
                'role' => ['Super Admin', 'Manager'],
                'active' => 'management-tugas',
                'route' => 'management-tugas'
            ]),collect([
                'nama' => 'Daftar Tugas',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3"
                            d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z"
                            fill="currentColor" />
                        <path
                            d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z"
                            fill="currentColor" />
                    </svg>',
                'role' => ['Super Admin', 'Manager', 'Worker'],
                'active' => 'daftar-tugas',
                'route' => 'daftar-tugas'
            ]),
            // collect([
            //     'nama' => 'Accounts',
            //     'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            //             <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="currentColor"/>
            //             <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="currentColor"/>
            //         </svg>',
            //     'role' => ['Super Admin', 'Manager'],
            //     'active' => 'accounts',
            //     'route' => null,
            //     'children' => collect([
            //         collect([
            //             'nama' => 'Receivable',
            //             'icon' => '<span class="bullet bullet-dot"></span>',
            //             'role' => ['Super Admin', 'Manager'],
            //             'active' => 'receivable',
            //             'route' => 'pre-order.account-receivable'
            //         ]),
            //         collect([
            //             'nama' => 'Payable',
            //             'icon' => '<span class="bullet bullet-dot"></span>',
            //             'role' => ['Super Admin', 'Manager'],
            //             'active' => 'payable',
            //             'route' => 'supplier-order.payable'
            //         ]),
            //     ])
            // ]),
            collect([
                'nama' => 'Laporan',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor"/>
                            <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor"/>
                            <path d="M10.3629 14.0084L8.92108 12.6429C8.57518 12.3153 8.03352 12.3153 7.68761 12.6429C7.31405 12.9967 7.31405 13.5915 7.68761 13.9453L10.2254 16.3488C10.6111 16.714 11.215 16.714 11.6007 16.3488L16.3124 11.8865C16.6859 11.5327 16.6859 10.9379 16.3124 10.5841C15.9665 10.2565 15.4248 10.2565 15.0789 10.5841L11.4631 14.0084C11.1546 14.3006 10.6715 14.3006 10.3629 14.0084Z" fill="currentColor"/>
                        </svg>',
                'role' => ['Super Admin', 'Manager', 'Admin Gudan'],
                'active' => 'laporan',
                'route' => null,
                'children' => collect([
                    collect([
                        'nama' => 'Account Payable',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'laporan-account-payable',
                        'route' => 'laporan.account-payable'
                    ]),
                    collect([
                        'nama' => 'Account Receivable',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'laporan-account-receivable',
                        'route' => 'laporan.account-receivable'
                    ]),
                    collect([
                        'nama' => 'Kalender Accounts',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'kalender',
                        'route' => 'laporan.kalender'
                    ]),
                    collect([
                        'nama' => 'Stock Minimum',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'spareparts',
                        'route' => 'laporan.spareparts'
                    ]),
                    collect([
                        'nama' => 'Laporan Stok Opname',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'stock-opname-miss',
                        'route' => 'laporan.stock-opname'
                    ]),
                    collect([
                        'nama' => 'Log Activity',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'log-activity',
                        'route' => 'laporan.log-activity'
                    ]),
                    // collect([
                    //     'nama' => 'Revenue',
                    //     'icon' => '<span class="bullet bullet-dot"></span>',
                    //     'role' => ['Super Admin', 'Manager'],
                    //     'active' => 'grafik-penjualan',
                    //     'route' => 'laporan.grafik-penjualan'
                    // ]),
                    // collect([
                    //     'nama' => 'Gross Profit',
                    //     'icon' => '<span class="bullet bullet-dot"></span>',
                    //     'role' => ['Super Admin', 'Manager'],
                    //     'active' => 'profit-po',
                    //     'route' => 'laporan.profit-pre-order'
                    // ]),
                ])
            ]),

            collect([
                'nama' => 'Inventory',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"/>
                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"/>
                        </svg>',
                'role' => ['Super Admin', 'Manager', 'Admi Gudang'],
                'active' => 'inventory',
                'route' => null,
                'children' => collect([
                    collect([
                        'nama' => 'Stock',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'stock',
                        'route' => 'inventory'
                    ]),
                    collect([
                        'nama' => 'Stock Opname',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'stock-opname',
                        'route' => 'inventory.stock-opname'
                    ]),
                    collect([
                        'nama' => 'Pinjam Meminjam',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager', 'Admin Gudang'],
                        'active' => 'pinjam-meminjam',
                        'route' => 'pinjam-meminjam'
                    ]),
                    collect([
                        'nama' => 'Rak',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager', 'Admin Gudan'],
                        'active' => 'rak',
                        'route' => 'rak'
                    ]),
                ])
            ]),
            collect([
                'nama' => 'Data Master',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
                                fill="currentColor" />
                            <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
                                fill="currentColor" />
                            <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
                                fill="currentColor" />
                            <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="currentColor" />
                            <path opacity="0.3"
                                d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
                                fill="currentColor" />
                            <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z"
                                fill="currentColor" />
                        </svg>',
                'role' => ['Super Admin', 'Manager'],
                'active' => 'data-master',
                'route' => null,
                'children' => collect([
                    collect([
                        'nama' => 'Project',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'project',
                        'route' => 'project'
                    ]),
                    collect([
                        'nama' => 'Form',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'form',
                        'route' => 'form'
                    ]),
                    collect([
                        'nama' => 'Data Pekerja',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'worker',
                        'route' => 'worker'
                    ]),
                    collect([
                        'nama' => 'Data Supplier',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'supplier',
                        'route' => 'supplier'
                    ]),
                    collect([
                        'nama' => 'Data Customer',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'kostumer',
                        'route' => 'kostumer'
                    ]),
                    collect([
                        'nama' => 'Barang',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'barang',
                        'route' => 'barang'
                    ]),
                    collect([
                        'nama' => 'Kategori',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'kategori',
                        'route' => 'kategori'
                    ]),
                    collect([
                        'nama' => 'Merk',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'merk',
                        'route' => 'merk'
                    ]),
                    collect([
                        'nama' => 'Tipe Barang',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'tipe-barang',
                        'route' => 'tipe-barang'
                    ]),
                    collect([
                        'nama' => 'Satuan',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'satuan',
                        'route' => 'satuan'
                    ]),
                    collect([
                        'nama' => 'Tipe Pembayaran',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'tipe-pembayaran',
                        'route' => 'tipe_pembayaran'
                    ]),
                    collect([
                        'nama' => 'Metode Pembayaran',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'metode-pembayaran',
                        'route' => 'metode-pembayaran'
                    ]),
                    collect([
                        'nama' => 'Tipe User',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'tipeUser',
                        'route' => 'tipe_user'
                    ]),
                    collect([
                        'nama' => 'Pekerjaan',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'pekerjaan',
                        'route' => 'pekerjaan'
                    ]),
                    collect([
                        'nama' => 'Kondisi',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'kondisi',
                        'route' => 'kondisi'
                    ]),
                    collect([
                        'nama' => 'Sales',
                        'icon' => '<span class="bullet bullet-dot"></span>',
                        'role' => ['Super Admin', 'Manager'],
                        'active' => 'sales',
                        'route' => 'sales'
                    ]),
                ]),
            ]),
                collect([
                    'nama' => 'Pengaturan Web',
                    'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M11.8 5.2L17.7 8.6V15.4L11.8 18.8L5.90001 15.4V8.6L11.8 5.2ZM11.8 2C11.5 2 11.2 2.1 11 2.2L3.8 6.4C3.3 6.7 3 7.3 3 7.9V16.2C3 16.8 3.3 17.4 3.8 17.7L11 21.9C11.3 22 11.5 22.1 11.8 22.1C12.1 22.1 12.4 22 12.6 21.9L19.8 17.7C20.3 17.4 20.6 16.8 20.6 16.2V7.9C20.6 7.3 20.3 6.7 19.8 6.4L12.6 2.2C12.4 2.1 12.1 2 11.8 2Z"
                                    fill="currentColor"></path>
                                <path d="M11.8 8.69995L8.90001 10.3V13.7L11.8 15.3L14.7 13.7V10.3L11.8 8.69995Z"
                                    fill="currentColor"></path>
                            </svg>',
                    'role' => ['Super Admin', 'Manager'],
                    'active' => 'web_config',
                    'route' => 'web-config'
            ]),
            ]);
    }
    public function getListTipeBarang(){
        return collect([
            collect([
                'tipe_barang' => 1,
                'keterangan' => 'Bisa Dipinjam'
            ]),collect([
                'tipe_barang' => 2,
                'keterangan' => 'Bisa Dibeli'
            ]),collect([
                'tipe_barang' => 3,
                'keterangan' => 'Bisa Dipinjam atau Dibeli'
            ]),
        ]);
    }

    public function getListStatusBarang(){
        return collect([
            collect([
                'status_barang' => 1,
                'keterangan' => 'Dipinjam'
            ]),
            collect([
                'status_barang' => 2,
                'keterangan' => 'Diminta'
            ]),
        ]);
    }

    public function getListStatusOrder(){
        return collect([
            collect([
                'status_order' => '1',
                'keterangan' => 'Sedang Diajukan',
                'badge' => "<span class='badge badge-primary'>Sedang Diajukan</span>"
            ]),
            collect([
                'status_order' => '2',
                'keterangan' => 'Sedang Diproses',
                'badge' => "<span class='badge badge-warning'>Sedang Diproses</span>"
            ]),
            collect([
                'status_order' => '3',
                'keterangan' => 'Dalam Pengiriman',
                'badge' => "<span class='badge badge-warning'>Dalam Pengiriman</span>"
            ]),
            collect([
                'status_order' => '4',
                'keterangan' => 'Selesai',
                'badge' => "<span class='badge badge-success'>Selesai</span>"
            ]),
            collect([
                'status_order' => '0',
                'keterangan' => 'Dibatalkan / Ditolak',
                'badge' => "<span class='badge badge-danger'>Dibatalkan / Ditolak</span>"
            ]),
        ]);
    }

    public static function getListVersion(){
        $version = [];
        for ($i=0; $i <= 10; $i++) {
            array_push($version,$i);
        }

        return $version;
    }

    public function getListStatusResponse(){
        return collect([
            collect([
                'status_response' => '1',
                'keterangan' => "Sudah diresponse",
                'badge' => "<span class='badge badge-success'>Sudah diresponse</span>"
            ]),collect([
                'status_response' => '2',
                'keterangan' => "Belum diresponse",
                'badge' => "<span class='badge badge-secondary'>Belum diproses</span>"
            ]),collect([
                'status_response' => '0',
                'keterangan' => "Belum dikirim",
                'badge' => "<span class='badge badge-warning'>Belum dikirim</span>"
            ]),collect([
                'status_response' => '3',
                'keterangan' => "Tidak diresponse",
                'badge' => "<span class='badge badge-danger'>Tidak diresponse</span>"
            ])
            ]);
    }

    function format_num ($input, $pad_len = 7, $prefix = null) {
        if ($pad_len <= strlen($input))
            trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

        if (is_string($prefix))
            return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }

    function format_romawi($number){
        if($number > 12){
            return "Inputan tidak boleh lebih dari 12";
        }

        switch ($number){

            case 1:

                return "I";

                break;

            case 2:

                return "II";

                break;

            case 3:

                return "III";

                break;

            case 4:

                return "IV";

                break;

            case 5:

                return "V";

                break;

            case 6:

                return "VI";

                break;

            case 7:

                return "VII";

                break;

            case 8:

                return "VIII";

                break;

            case 9:

                return "IX";

                break;

            case 10:

                return "X";

                break;

            case 11:

                return "XI";

                break;

            case 12:

                return "XII";

                break;

            default:
                return "Inputan tidak valid !";
                break;
      }
    }

    static public function user(){
        return User::find(session()->get('id_user'));
    }

    static public function createAgenda(){
        // Check Agenda Account Payable
        $accountPayable = SupplierOrder::doesntHave('agendaPembayaran')
        ->where('status_pembayaran', '!=', 2)
        ->where('status_order', '!=', 0)
        ->get();

        foreach ($accountPayable as $item) {
            $calenderPenagihan = CalenderPenagihan::where('tipe', 1)
            ->where('id_accounts', $item->id)
            ->where('tanggal', $item->tanggal_tempo_pembayaran)
            ->first();
            $description = 'Pembayaran Supplier Order ke ' . $item->supplier->name . ' sebesar ' . $item->total_harga_formatted . '. Silahkan lakukan pembayaran sebelum ' . date('d-m-Y', strtotime($item->tanggal_tempo_pembayaran));
            if(!$calenderPenagihan){
                CalenderPenagihan::create([
                    'tipe' => 1,
                    'id_accounts' => $item->id,
                    'tanggal' => $item->tanggal_tempo_pembayaran,
                    'description' => $description
                ]);
            }else{
                $calenderPenagihan->update([
                    'description' => $description
                ]);
            }
        }

        // Check Agenda Account Receivable
        $accountReceivable = PreOrder::doesntHave('agendaPenagihan')
        ->whereHas('quotation', function($query){
            $query->whereHas('laporanPekerjaan', function($query){
                $query->where('signature', '!=', null)
                ->where('jam_selesai', '!=', null);
            });
        })->where('status', '!=', 3)->get();

        foreach ($accountReceivable as $item) {
            $calenderPenagihan = CalenderPenagihan::where('tipe', 2)
            ->where('id_accounts', $item->id)
            ->where('tanggal', $item->tanggal_tempo_pembayaran)
            ->first();
            $nama_customer = null;
            if($item->id_quotation != null){
                $nama_customer = $item->quotation->projectUnit->project->customer->nama;
            }elseif($item->id_project_unit != null){
                $nama_customer = $item->projectUnit->project->customer->nama;
            }
            $description = 'Penagihan PO ke ' . $nama_customer . ' sebesar ' . $item->total_bayar_formatted . '. Silahkan lakukan pembayaran sebelum ' . date('d-m-Y', strtotime($item->tanggal_tempo_pembayaran));
            if(!$calenderPenagihan){
                CalenderPenagihan::create([
                    'tipe' => 2,
                    'id_accounts' => $item->id,
                    'tanggal' => $item->tanggal_tempo_pembayaran,
                    'description' => $description
                ]);
            }else{
                $calenderPenagihan->update([
                    'description' => $description
                ]);
            }
        }

        // Check Quotation
        $quotation = Quotation::doesntHave('agendaPembuatan')
        ->get();

        foreach ($quotation as $item) {
            $description = 'Pembuatan Quotation dilakukan pada tanggal ' . date('d-m-Y', strtotime($item->created_at));
            CalenderPenagihan::create([
                'tipe' => 3,
                'id_accounts' => $item->id,
                'tanggal' => $item->created_at,
                'description' => $description
            ]);
        }

        //Laporan Pekerjaan
        $laporanPekerjaan = LaporanPekerjaan::doesntHave('agendaLaporanPekerjaan')
        ->where('signature', '!=', null)
        ->where('jam_selesai', '!=', null)
        ->get();
        foreach ($laporanPekerjaan as $item) {
            $tanggalPekerjaan = $item->tanggal_pekerjaan ? date('d-m-Y', strtotime($item->tanggal_pekerjaan)) : '-';
            $description = 'Pekerjaan dengan kode pekerjaan ('. $item->no_ref .') pada Customer '. $item->projectUnit->project->customer->nama . ' Dilakukan pekerjaan pada tanggal ' . $tanggalPekerjaan;
            CalenderPenagihan::create([
                'tipe' => 4,
                'id_accounts' => $item->id,
                'tanggal' => $item->tanggal_pekerjaan,
                'description' => $description
            ]);
        }
    }
}

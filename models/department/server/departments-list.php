<?php

    // require database parameters file
    require "../../../constants/db_constants.php";

    // set database parameters in new variables
    $sqlParams = [
        'host' => HOSTNAME,
        'user' => USERNAME,
        'pass' => PASSWORD,
        'db' => DATABASE
    ];

    // table
    $table = 'departments';

    // PK
    $primary_key = "id";

    // get all columns to display
    $columns = [
        [
            'db' => '`name`', 
            'dt' => 0, 
            'field' => 'name'
        ],
        [
            'db' => '`name`', 
            'dt' => 1, 
            'formatter' => function($d, $row){
                // $counter = count($d);
                // for($x=1; $x <= count($row["name"]); $x++){
                    // return sprintf("%03d", $counter);
                    return ($d);
                // }
                
            },
            'field' => 'name'
        ],
        [
            'db' => '`status`', 
            'dt' => 2, 
            'formatter' => function($d, $row){
                if($d === 1)
                    return '
                        <span class="badge light badge-success text-uppercase">
                            <i class="fa fa-circle text-success me-1"></i>
                            active
                        </span>  
                    ';
                return '
                    <span class="badge light badge-danger text-uppercase">
                        <i class="fa fa-circle text-danger me-1"></i>
                        disabled
                    </span>  
                ';
            },
            'field' => 'status'
        ],
        [
            'db' => '`id`', 
            'dt' => 3,
            'formatter' => function($d, $row){
                return '
                    <div class="dropdown ms-auto text-end">
                        <div class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                </g>
                            </svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target=".edit-department-modal" data-id="'.$d.'">Edit</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target=".delete-department-modal" data-id="'.$d.'">Delete</a>
                        </div>
                    </div>
                ';
            },
            'field' => 'id'
        ]
    ];

    // include the ssp script for data handling
    require "../../../models/ssp.class.php";

    // join Query
    $joinQuery = 'FROM `departments`';
    // $extraWhere = '`deleted_at` = NULL';

    echo json_encode(
        SSP::simple($_GET, $sqlParams, $table, $primary_key, $columns, $joinQuery)
    );
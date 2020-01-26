<?php
use CustomTheme\Model\DataProvider;

$departments = DataProvider::getDepartments();

// get the current page params
$current_department = get_query_var('department', -1);
$current_page = get_query_var('page', 0);

// get filtered jobs
$result = DataProvider::getJobs( $current_department, $current_page);
$total = DataProvider::$jobsCount;


$context = Timber::context();
// pass data to Templates
$context['jobs'] = $result;
$context['departments'] = $departments;
$context['currentDepartment'] = $current_department;
$context['pager'] = [
    'total' => $total,
    'current' => $current_page,
    'link' => $current_department != -1 ? '?department=' . $current_department .'&page='  : '?page=',
    'per_page' => DataProvider::PER_PAGE_ITEMS,
    'pages' => (int)ceil($total / DataProvider::PER_PAGE_ITEMS)
] ;

Timber::render( 'index.twig', $context );


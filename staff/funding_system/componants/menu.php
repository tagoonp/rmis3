<aside id="sidebar-wrapper">
  <ul class="sidebar-menu mt-2">
    <li class=""><a class="nav-link" href="../"><i class="fas fa-chevron-left"></i> <span>กลับสู่ RMIS</span></a></li>
    <li class="<?php add_class_active('sub-menu', 'index'); ?>"><a class="nav-link" href="index"><i class="fas fa-home"></i> <span>แดชบอร์ด</span></a></li>
    <li class="menu-header">Contents</li>
    <li class="nav-item dropdown <?php add_class_active('main-menu', 1); ?>">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i> <span>การจัดการ</span></a>
      <ul class="dropdown-menu">
        <li class="<?php add_class_active('sub-menu', 'project_list'); ?>"><a class="nav-link" href="project_list">โครงการทั้งหมด</a></li>
        <li class="<?php add_class_active('sub-menu', 'search_result'); ?>"><a class="nav-link" href="search_result">ค้นหาโครงการ</a></li>
        <li class="<?php add_class_active('sub-menu', 'project_manage'); ?>"><a class="nav-link" href="project_manage">จัดการข้อมูลทุน</a></li>
      </ul>
    </li>
    <li class="nav-item dropdown <?php add_class_active('main-menu', 2); ?>">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-line"></i> <span>รายงาน</span></a>
      <ul class="dropdown-menu">
        <li class="<?php add_class_active('sub-menu', 'modules-page-list'); ?>"><a class="nav-link" href="modules-page-list">ส่งออกข้อมูล</a></li>
      </ul>
    </li>
  </ul>
</aside>

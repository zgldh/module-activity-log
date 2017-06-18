<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>操作记录
        <small>列表</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <router-link to="/"><i class="fa fa-dashboard"></i> 总览</router-link>
        </li>
        <li><a href="#">操作记录</a></li>
        <li class="active">列表</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="app-page-table" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>

    </section>
    <!-- /.content -->
  </div>
</template>

<script type="javascript">
  import datatablesHelper from 'resources/assets/js/commons/datatables-helper.js';
  import vueHelper from 'resources/assets/js/commons/vuejs.js';
  import columns from './TableColumns';

  let appPageTable = null;
  let resourceURL = "/actionlog";
  let datatablesConfig = datatablesHelper.buildDatatablesConfig({
    resource: resourceURL
  }, columns);
  datatablesConfig.columns.pop();
  datatablesConfig.order = [[5, "desc"]];

  let vueConfig = vueHelper.buildVueConfig(resourceURL, datatablesConfig);
  export default vueConfig;
</script>

<style lang="scss">

</style>

<template>
  <div class="admin-list-page">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{$t('module_activity_log.title')}}
        <small>{{$t('scaffold.terms.list')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <router-link to="/"><i class="fa fa-dashboard"></i> {{$t('module_dashboard.title')}}</router-link>
        </li>
        <li><a href="#">{{$t('module_activity_log.title')}}</a></li>
        <li class="active">{{$t('scaffold.terms.list')}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <!--<div class="box-header with-border">-->
        <!--<div class="buttons">-->
        <!--</div>-->
        <!--</div>-->
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body datatable-loading-section">
          <div class="search">
            <el-form :inline="true" :model="searchForm" ref="searchForm">
              <el-form-item :label="$t('module_activity_log.models.activity_log.fields.subject_type')">
                <el-input v-model="searchForm.subject_type" column="subject_type"
                          operator="like"></el-input>
              </el-form-item>
              <el-form-item :label="$t('module_activity_log.models.activity_log.fields.subject_id')">
                <el-input v-model="searchForm.subject_id" column="subject_id"
                          operator="="></el-input>
              </el-form-item>
              <el-form-item :label="$t('module_activity_log.models.activity_log.fields.description')">
                <el-input v-model="searchForm.description" column="description"
                          operator="like"></el-input>
              </el-form-item>
              <el-form-item :label="$t('module_activity_log.models.activity_log.fields.causer_id')">
                <el-input v-model="searchForm.causer_id" column="causer_id"
                          operator="="></el-input>
              </el-form-item>
              <el-form-item :label="$t('scaffold.fields.created_at')">
                <el-date-picker
                        v-model="searchForm.created_at"
                        type="daterange"
                        clearable
                        column="created_at"
                        operator="range">
                </el-date-picker>
              </el-form-item>

              <el-form-item>
                <el-button-group>
                  <el-button type="primary" @click="onSubmitSearch">{{$t('scaffold.terms.search_submit')}}</el-button>
                  <el-button type="button" @click="onResetSearch">{{$t('scaffold.terms.search_reset')}}</el-button>
                </el-button-group>
              </el-form-item>
            </el-form>
          </div>

          <div class="datatable-container">
            <!-- 采用 datatables 标准-->
            <el-row class="tools">
              <el-col :span="4">
                <span class="page-size">{{$t('scaffold.terms.page_size_show')}}
                <el-select v-model="pagination.pageSize" style="width: 80px"
                           @change="onPageSizeChange">
                  <el-option
                          v-for="item in pagination.pageSizeList"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                  </el-option>
                </el-select>
                  {{$t('scaffold.terms.page_size_items')}}</span>
              </el-col>
              <el-col :span="12">
                <el-pagination
                        @current-change="onPageChange"
                        :current-page="pagination.currentPage"
                        :page-size="pagination.pageSize==-1?1:pagination.pageSize"
                        :layout="pagination.pageSize==-1?'total':'total, prev, pager, next, jumper'"
                        :total="pagination.totalCount">
                </el-pagination>
              </el-col>
              <el-col :span="8">
                <el-input class="auto-search" style="width: 200px;float: right;"
                          :placeholder="$t('scaffold.terms.auto_search')"
                          v-model="datatablesParameters.search.value"
                          :icon="datatablesParameters.search.value?'close':'search'"
                          :on-icon-click="onAutoSearchIconClick"
                          @change="onAutoSearchChanged">
                </el-input>
              </el-col>
            </el-row>

          </div>
          <div class="datatable" style="margin-top:1em;">
            <el-table
                    :data="tableData"
                    border
                    style="width: 100%"
                    max-height="500"
                    :default-sort="defaultSort"
                    @sort-change="onSortChange"
                    @selection-change="onSelectionChange"
                    ref="table"
            >
              <el-table-column
                      prop="subject_id"
                      :label="$t('module_activity_log.models.activity_log.fields.subject_id')"
                      :sortable="false"
                      show-overflow-tooltip
                      width="120">
              </el-table-column>
              <el-table-column
                      prop="subject_type"
                      :label="$t('module_activity_log.models.activity_log.fields.subject_type')"
                      :sortable="false"
                      show-overflow-tooltip>
              </el-table-column>
              <el-table-column
                      prop="description"
                      :label="$t('module_activity_log.models.activity_log.fields.description')"
                      :sortable="false"
                      show-overflow-tooltip>
              </el-table-column>
              <el-table-column
                      prop="causer_id"
                      :label="$t('module_activity_log.models.activity_log.fields.causer_id')"
                      :sortable="true"
                      show-overflow-tooltip
                      width="130">
              </el-table-column>
              <el-table-column
                      prop="created_at"
                      :label="$t('scaffold.fields.created_at')"
                      sortable="custom"
                      searchable="false"
                      show-overflow-tooltip
                      width="190">
              </el-table-column>
            </el-table>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
</template>

<script type="javascript">
  import {mixin} from "resources/assets/js/commons/ListHelpers.js";
  import {loadModuleLanguage} from 'resources/assets/js/commons/LanguageHelper';

  export default {
    mixins: [
      mixin,
      loadModuleLanguage('module_activity_log')
    ],
    data: function () {
      let data = {
        resource: '/activity_log',
        datatablesParameters: {
          order: [{column: 'created_at', dir: 'desc'}],
        },
        searchForm: {
          subject: null,
          description: null,
          created_at: null
        }
      };
      return data;
    },
    methods: {}
  };

</script>

<style lang="scss" scoped>

</style>

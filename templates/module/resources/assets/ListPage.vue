<template>
  <div class="admin-list-page">
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

      <div class="box">
        <div class="box-header with-border">
          <div class="buttons">
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body datatable-loading-section">
          <div class="search">
            <el-form :inline="true" :model="searchForm" ref="searchForm">
              <el-form-item label="Type">
                <el-input v-model="searchForm.type" placeholder="Type" column="type" operator="like"></el-input>
              </el-form-item>
              <el-form-item label="Content">
                <el-input v-model="searchForm.content" placeholder="Content" column="content"
                          operator="like"></el-input>
              </el-form-item>
              <el-form-item label="Ip">
                <el-input v-model="searchForm.ip" placeholder="Ip" column="ip" operator="like"></el-input>
              </el-form-item>
              <el-form-item label="Agent">
                <el-input v-model="searchForm.user_agent" placeholder="User_agent" column="user_agent"
                          operator="like"></el-input>
              </el-form-item>
              <el-form-item label="Created At">
                <el-date-picker
                        v-model="searchForm.created_at"
                        type="daterange"
                        placeholder="选择日期范围"
                        clearable
                        column="created_at"
                        operator="range">
                </el-date-picker>
              </el-form-item>

              <el-form-item>
                <el-button-group>
                  <el-button type="primary" @click="onSubmitSearch">查询</el-button>
                  <el-button type="button" @click="onResetSearch">清空</el-button>
                </el-button-group>
              </el-form-item>
            </el-form>
          </div>

          <div class="datatable-container">
            <!-- 采用 datatables 标准-->
            <el-row class="tools">
              <el-col :span="4">
                <span class="page-size">显示
                <el-select v-model="pagination.pageSize" style="width: 80px"
                           @change="onPageSizeChange">
                  <el-option
                          v-for="item in pagination.pageSizeList"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                  </el-option>
                </el-select>
                  项结果</span>
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
                          placeholder="模糊搜索"
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
                      prop="type"
                      label="Type"
                      :sortable="false"
                      show-overflow-tooltip
                      width="100">
              </el-table-column>
              <el-table-column
                      prop="content"
                      label="Content"
                      :sortable="false"
                      show-overflow-tooltip>
              </el-table-column>
              <el-table-column
                      prop="user_agent"
                      label="Agent"
                      :sortable="false"
                      show-overflow-tooltip
                      width="240">
              </el-table-column>
              <el-table-column
                      prop="ip"
                      label="IP"
                      :sortable="false"
                      show-overflow-tooltip
                      width="100">
              </el-table-column>
              <el-table-column
                      prop="created_at"
                      label="Created At"
                      sortable="custom"
                      searchable="false"
                      show-overflow-tooltip
                      width="190">
              </el-table-column>
              <el-table-column
                      fixed="right"
                      label="操作"
                      width="100">
                <template scope="scope">
                  <el-button-group>
                    <el-button @click="onViewClick(scope.row,scope.column,scope.$index,scope.store)" type="default"
                               size="small" icon="view" title="查看"></el-button>
                  </el-button-group>
                </template>
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

  export default {
    mixins: [mixin],
    data: function () {
      let data = {
        resource: '/action-log',
        datatablesParameters: {
          order: [{column: 'created_at', dir: 'desc'}],
        },
        searchForm: {
          type: null,
          content: null,
          ip: null,
          user_agent: null,
          created_at: null
        }
      };
      return data;
    },
    methods: {
      onViewClick: function (row, column, $index, store) {
        return window.open(row.url);
      }
    }
  };

</script>

<style lang="scss" scoped>

</style>

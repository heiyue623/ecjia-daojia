<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.platform.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<!-- 批量操作和搜索 -->
<div class="row-fluid batch" >
	<form method="post" action="{$search_action}" name="searchForm">
		<div class="btn-group f_l m_r5">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fontello-icon-cog"></i>{t domain="platform"}批量操作{/t}
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a class="button_remove" data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url='{url path="platform/admin/batch_remove"}' 
				data-msg='{t domain="platform"}您确定要这么做吗？{/t}' data-noSelectMsg='{t domain="platform"}请先选中要删除的公众号！{/t}' 
				data-name="id" href="javascript:;"><i class="fontello-icon-trash"></i>{t domain="platform"}删除公众号{/t}</a></li>
			</ul>
		</div>
		
		<select class="w150" name="platform" id="select_type">
			<option value=''  		{if $smarty.get.platform eq ''}			selected="true"{/if}>{t domain="platform"}所有平台{/t}</option>
			<option value='wechat' 	{if $smarty.get.platform eq 'wechat'}	selected="true"{/if}>{t domain="platform"}微信{/t}</option>
		</select>
		<a class="btn m_l5 screen-btn">{t domain="platform"}筛选{/t}</a>
		<div class="choose_list f_r" >
			<input type="text" name="keywords" value="{$smarty.get.keywords}" placeholder='{t domain="platform"}请输入公众号名称关键字{/t}' />
			<button class="btn search_wechat" type="submit">{t domain="platform"}搜索{/t}</button>
		</div>
	</form>
</div>

<div class="row-fluid list-page">
	<div class="row-fluid">	
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
					<th class="table_checkbox"><input type="checkbox" name="select_rows" data-toggle="selectall" data-children=".checkbox"/></th>
					<th class="w150">{t domain="platform"}Logo{/t}</th>
					<th class="w250">{t domain="platform"}公众号名称{/t}</th>
					<th class="w150">{t domain="platform"}平台{/t}</th>
					<th class="w150">{t domain="platform"}公众号类型{/t}</th>
					<th class="w100">{t domain="platform"}状态{/t}</th>
					<th class="w100">{t domain="platform"}排序{/t}</th>
					<th class="w200">{t domain="platform"}添加时间{/t}</th>
				</tr>
			</thead>
			<tbody>
				<!-- {foreach from=$wechat_list.item item=val} -->
				<tr class="big">
					<td>
						<span><input type="checkbox" name="checkboxes[]" class="checkbox" value="{$val.id}"/></span>
					</td>
					<td><img class="thumbnail" src="{$val.logo}"></td>
					<td class="hide-edit-area">
						{$val.name}<br>
						{$val.uuid}
						<div class="edit-list">
							<a target="_blank" href='{RC_Uri::url("platform/admin/autologin", "id={$val.id}")}' title='{t domain="platform"}进入管理{/t}'>{t domain="platform"}进入管理{/t}</a> &nbsp;|&nbsp;
					      	<a class="data-pjax" href='{RC_Uri::url("platform/admin/edit", "id={$val.id}")}' title='{t domain="platform"}编辑{/t}'>{t domain="platform"}编辑{/t}</a> &nbsp;|&nbsp;
					     	<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t domain="platform" 1={$val.name}}您确定要删除公众号[%1]吗？{/t}' href='{RC_Uri::url("platform/admin/remove", "id={$val.id}")}' title='{t domain="platform"}删除{/t}'>{t domain="platform"}删除{/t}</a>
				     	</div>
					</td>
					<td>
						{if $val.platform eq 'wechat'}
                        {t domain="platform"}微信{/t}
						{/if}
					</td>
					<td>
						{if $val.type eq 0}
                        {t domain="platform"}未认证的公众号{/t}
						{elseif $val.type eq 1}
                        {t domain="platform"}订阅号{/t}
						{elseif $val.type eq 2}
                        {t domain="platform"}服务号{/t}
						{elseif $val.type eq 3}
                        {t domain="platform"}测试账号{/t}
						{/if}
					</td>
					<td>
				        <i class="{if $val.status eq 1}fontello-icon-ok{else}fontello-icon-cancel{/if} cursor_pointer" data-trigger="toggleState" data-url="{RC_Uri::url('platform/admin/toggle_show')}" data-id="{$val.id}" ></i>
					</td>
					<td><span class="cursor_pointer" data-trigger="editable" data-url="{RC_Uri::url('platform/admin/edit_sort')}" data-name="sort" data-pk="{$val.id}"  data-title='{t domain="platform"}编辑公众号排序{/t}'>{$val.sort}</span></td>
					<td>
						{$val.add_time}
					</td>
				</tr>
				<!--  {foreachelse} -->
				<tr><td class="no-records" colspan="8">{t domain="platform"}没有找到任何记录{/t}</td></tr>
				<!-- {/foreach} -->
			</tbody>
		</table>
		<!-- {$wechat_list.page} -->
	</div>
</div> 
<!-- {/block} -->

	<form role="form">
		<p class=" input-group">
			<input type="text" class="form-control" ng-model="query" value="">
			<span class="input-group-btn">
				<button class="btn btn-primary"  ng-click="setQuery()" >
					<span class="glyphicon glyphicon-search"></span><?php echo __("検索"); ?>
				</button>
			</span>
		</p>
	</form>
</div>
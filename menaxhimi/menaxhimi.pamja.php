<?php

?>
    
<div class="page-header">
	<h1> Menaxhimi <small>Informacione t&euml; p&euml;rgjithshme</small></h1>
</div>
<div class="col-md-6">
	<form role="form" id="page_info" action="menaxhimi.php" method="POST">
		<div class="form-group">
			<label for="title">Titulli</label>
			<input class="form-control" type="text" name="title" value='<?php echo $page->getTitle(); ?>' id="title" />
		</div>
		<div class="form-group">
			<label for="footer">Footer</label>
			<input type="text" value='<?php echo $page->getFooter(); ?>' class="form-control" id="footer" name="footer"/>
		</div>
		<div class="form-group">
			<input type="submit" name="title-footer-submit" value="Ruaj!" class="btn btn-md btn-danger"/>
		</div>
	</form>
</div>
<div class="col-md-6">
	<script type="text/javascript">
        $(function() {
            $('#onlineoffline').bind('submit', function(){
                $.ajax({
                    type: 'post',
                    url: "menaxhimi.php",
                    data: $("#onlineoffline").serialize(),
                    success: function(info) {
                        $('#onoff').html(info);
                    }
                });
                return false;
            });
        });
    </script>
	<form role="form" method="POST" action="menaxhimi.php" id="onlineoffline">
	<label> Aktivizimi i faqes </label>
		<div class="form-group" id="onoff">

		<?php
			if($page->isActivated() == 1){
				echo '<input type="hidden" name="online" value="1"/>
			<p class="bg-success text-left"><input name="online-offline-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-success" value="Online"/> Faqja &euml;sht&euml; aktive!<span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
			else{
				echo '<input type="hidden" name="offline" value="1"/>
			<p class="bg-danger text-left"><input name="online-offline-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-danger" value="Offline"/> Faqja &euml;sht&euml; e ndalur!<span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		?>
		</div>
	</form>
	 <script type="text/javascript">
        $(function() {
            $('#votimOnOff').bind('submit', function(){
                $.ajax({
                    type: 'post',
                    url: "menaxhimi.php",
                    data: $("#votimOnOff").serialize(),
                    success: function(info) {
                        $('#votim').html(info);
                    }
                });
                return false;
            });
        });
    </script>
	<form role="form" method="POST" id="votimOnOff">
	<label> Vler&euml;simi i profesor&euml;ve </label>
		<div class="form-group" id="votim">
		<?php
			if($page->getVleresimi() == 1){
				echo '<input type="hidden" name="votimOn" value="1"/>
			<p class="bg-success text-left"><button name="votimOnOff-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-success">Online</button> Vler&euml;simi &euml;sht&euml; aktiv!<span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
			else{
				echo '<input type="hidden" name="votimOff" value="1"/>
			<p class="bg-danger text-left"><button name="votimOnOff-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-danger">Offline</button> Vler&euml;simi &euml;sht&euml; ndalur!<span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
			}
		?>
		</div>
	</form>
</div>
<?php
	$id = $_GET['ligjerata'];
	$ligjerata = new Ligjerata($id);
?>
<div class="col-md-12">
	<ol class="breadcrumb">
	  <li><a href="index.php?faqja=lendet">L&euml;nd&euml;t</a></li>
	  <li><a href="index.php?faqja=lendet&lenda=<?php echo $lenda->getID(); ?>"><?php echo $lenda->getEmri(); ?></a></li>
	  <li class="active"><?php echo $ligjerata->getAlias(). ' - '.$ligjerata->getEmri(); ?></li>
	</ol>
</div>
<div class="col-md-12">
	<div class="page-header">
	  <h1><?php echo $ligjerata->getEmri(); ?><small class="pull-right"><a data-toggle="modal" data-target="#ndrysho" class="btn btn-md btn-default"><i class="fa fa-pencil-square-o"></i> Ndrysho</a></small></h1>
	 	<div class="modal fade" id="ndrysho" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    <form action="ligjerata.php?ndryshoLigjerate=<?php echo $ligjerata->getID(); ?>" enctype="multipart/form-data" method="POST" role="form">
				    <input type="hidden" name="LID" value="<?php echo $lenda->getID(); ?>"/>
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Ndrysho ligj&euml;rat&euml;</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row">
				        	<div class="form-group col-md-2">
				        		<label for="alias">Alias</label>
				        		<input type="text" class="form-control" name="alias" value="<?php echo $ligjerata->getAlias();?>" id="alias" />
				        	</div>
				        	<div class="form-group col-md-10">
				        		<label for="emri">Emri</label>
				        		<input type="text" class="form-control" name="emri" value="<?php echo $ligjerata->getEmri(); ?>" id="emri" />
				        	</div>
				        </div>
				        <div class="row">
				        	<p><label>Ligj&euml;rata: </label> <span class="text-primary"><?php echo $ligjerata->getLink(); ?></span></p>
				        </div>
				        <div class="row">
				        	<div class="form-group col-md-12">
				        		<label for="ligjerata">Ngarko tjet&euml;r ligj&euml;rat&euml;</label>
				        		<input type="file" name="ligjerata" id="ligjerata" class="form-control" />
				        	</div>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
				        <button type="submit" class="btn btn-primary">Ruaj</button>
				      </div>
				     </form>
				    </div>
				  </div>
				</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
		<iframe src="http://docs.google.com/viewer?url=http://178.175.120.234/portal/<?php echo $ligjerata->getLink();?>&embedded=true" width="100%" height="780" style="border: none;">
		</iframe>
		</div>
		<div class="panel-footer">
		<span><i class="fa fa-calendar"></i> <?php echo rregulloDaten($ligjerata->getData()); ?></span>
		<span class="pull-right"><?php echo $ligjerata->getMadhesia(); ?> <i class="fa fa-file-text-o"></i></span>
		</div>
	</div>
</div>
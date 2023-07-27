<div class="container is-fluid mb-6">
	<h1 class="title">Ventas</h1>
	<h2 class="subtitle">Nueva venta</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/venta_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Id del Producto</label>
				  	<input class="input" type="text" name="venta_id" pattern="[0-9]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Cantidad Vendida</label>
				  	<input class="input" type="text" name="venta_cantidad" pattern="[0-9]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>
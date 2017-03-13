<div>
	<pre>Active sessions:
		<?PHP if(isset($_SESSION)): ?>
			<?PHP echo var_dump($_SESSION); ?>
		<?PHP else: ?>
			<?PHP echo "None" ?>
		<?PHP endif; ?>
	</pre>
	<pre>Active GETs:
		<?PHP if(isset($_GET)): ?>
			<?PHP echo var_dump($_GET); ?>
		<?PHP else: ?>
			<?PHP echo "None"; ?>
		<?PHP endif; ?>
	</pre>
	<pre>Active POSTs:
		<?PHP if(isset($_POST)): ?>
			<?PHP echo var_dump($_POST); ?>
		<?PHP else: ?>
			<?PHP echo "None"; ?>
		<?PHP endif; ?>
	</pre>
	<pre>
		<?PHP if(isset($_FILES)): ?>
			<?PHP echo var_dump($_FILES); ?>
		<?PHP else: ?>
			<?PHP echo "None"; ?>
		<?PHP endif; ?>
	</pre>
</div>
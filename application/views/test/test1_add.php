<p>This is random text for the CodeIgniter article. 
There's nothing to see here folks, just move along!</p>
<h2>Contact Us add</h2>
<?php 

				echo _platform;
				echo 'win'; 
				echo self::PLATFORM_WINDOWS;
				?>
<form class="cmxform" id="commentForm" method="get" action="">
	<fieldset>
		<legend>Please provide your name, email address (won't be published) and a comment</legend>
		<p>
			<label for="cname">Name (required, at least 2 characters)</label>
			<input id="cname" name="name" minlength="2" type="text" required />
		<p>
			<label for="cemail">E-Mail (required)</label>
			<input id="cemail" type="email" name="email" required />
		</p>
		<p>
			<label for="curl">URL (optional)</label>
			<input id="curl" type="url" name="url" />
		</p>
		<p>
			<label for="ccomment">Your comment (required)</label>
			<textarea id="ccomment" name="comment" required></textarea>
		</p>
		<p>
			<input class="submit" type="submit" value="Submit"/>
		</p>
	</fieldset>
</form>

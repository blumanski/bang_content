<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
	<!-- Search for small screen -->
	<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				
				<h5 class="breadcrumbs-title"><?php echo $this->Lang->write('content_scenes_add_headline');?></h5>
				<ol class="breadcrumbs">
					<li>
						<a href="/">
							<?php echo $this->Lang->write('app_breadcrumbs_home');?>
						</a>
						 <i class="mdi-hardware-keyboard-arrow-right" style="line-height: 15px;"></i>
						<?php echo $this->Lang->write('content_scenes_bread_module');?>
						</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!--breadcrumbs end-->
        
<!--start container-->
<div class="container content-wrapper">
	<div class="section">

		<nav>
			<div class="nav-wrapper">
				<ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="/content/scenes/index/"><?php echo $this->Lang->write('content_scene_show_list');?></a></li>
		        <li class="active"><a href="/content/scenes/addscene/"><?php echo $this->Lang->write('content_scene_show_add');?></a></li>
		        <li><a href="javascript:void(0);"><?php echo $this->Lang->write('content_scene_show_edit');?></a></li>
		      </ul>
			</div>
		</nav>

		<div class="action-wrapper">
			<div class="table-datatables">
				
			      <div class="row">
			      
			      <div class="col s12 m4">
			      
			      
			      	<div>
			      	<h4>Dont't worry yet, this is in work...</h4>
			      	<ul>
			      	<li>
			      		<h4>Add author, autocomplete while user is writing</h4><br />
			      		<i> If the author is not in our database, it will get entered newly and the book title will get assigned for future reference as well.<br />
    					Next time someone is adding a book for the same author, the autocomplete will show something like "Author Name - [example book title]. to make sure double names are dealt with." The user can select the right author (if authors with the same name occur).<br /><br />
			      		That process will probably get better over time.
			      		</i><br /><br />
			      	</li>
			      	
			      	<li>
			      		<h4>Add Book Title, adding the book title will look up the title while writing.</h4><br />
    The title is first looked up in our database and if not found in a remote database such as "http://isbndb.com/" or any other online service that suits the purpose.<br /><br />

    The search is always looking for the actual language.<br />
    Saying that, each scene can get edited in another language so that one can create a scene in multiple languages.
			      	</li>
					
					<li>
						<h4>Get book details.</h4><br />
						<i>If no book details available, the details will get loaded from http://isbndb.com/ API.<br />
    					The book details will get saved in our database so that we never need a remote service to display book listing on the front end, that would slow down too much.
						</i><br /><br />
					</li>
					
					<li>
						<h4>Remote Data for Books</h4>
						<p>
						Well, the service http://isbndb.com/ has 500 requests per day for free. Anymore cost a few dollars.
    On the http://isbndb.com API, 500 requests per day are free, we can work with that very well for now.<br /><br />
    In case that we need more, the price for 3000 requests per day is 29 USD, that is a good price. isbndb.com is actually the recommended by amazon as book api.<br /><br />
						
						isbndb.com is actually the recommended by amazon as book api.<br />
						<br />
						<a href="http://isbndb.com/account/dev" target="_blank">http://isbndb.com/account/dev</a>
						
						<br /><br />
						Let's talk theory, with the data, we can create a link to amazon and get money for each sale as an affiliate.<br />
    					Well, there are surely other options as well.
						
						</p>
					</li>
								      	
			      	</ul>
			      	
			      	
			      	</p>
			      	</div>
			      
			      	<form action="/content/scene/addscene/" method="post" id="addsceneform">

						<div class="row margin">
							<div class="input-field col s12">
					            <input 
					            	placeholder="<?php echo $this->Lang->write('content_scene_label_book_title');?>" 
					            	type="text" id="booktitle" 
					            	name="booktitle" 
					            	value="<?php if(isset($post['booktitle'])) { echo htmlspecialchars($post['booktitle'], ENT_QUOTES, 'UTF-8'); }?>" 
					            />
					            
					            <label for="author" class="center-align"><?php echo $this->Lang->write('content_scene_label_book_title');?></label>
					            <div class="valerror"></div>
							</div>
						</div>
			      	
			      		<div class="row margin">
							<div class="input-field col s12">
					            <input 
					            	placeholder="<?php echo $this->Lang->write('content_scene_label_book_author');?>" 
					            	type="text" id="author" 
					            	name="author" 
					            	value="<?php if(isset($post['author'])) { echo htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8'); }?>" 
					            />
					            
					            <input type="hidden" name="authorid" id="authorid" value="" />
					            
					            <label for="author" class="center-align"><?php echo $this->Lang->write('content_scene_label_author');?></label>
					            <div class="valerror"></div>
							</div>
						</div>
						
						<div class="row margin">
							<div class="input-field col s12">
					            <textarea 
					            	autocomplete="off"
					            	placeholder="<?php echo $this->Lang->write('content_scene_label_book_quote');?>" 
					            	id="quote" 
					            	name="quote" 
					            	class="materialize-textarea"
					            ><?php if(isset($post['quote'])) { echo htmlspecialchars($post['quote'], ENT_QUOTES, 'UTF-8'); }?></textarea>
					            
					            
					            <label for="author" class="center-align"><?php echo $this->Lang->write('content_scene_label_book_quote');?></label>
					            <div class="valerror"></div>
							</div>
						</div>


			      	
			      	</form>
			      
			      </div>
			      
			</div>
		</div>
	</div>
</div>
       

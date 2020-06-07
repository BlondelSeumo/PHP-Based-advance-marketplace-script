        <ul class="comment-section-auction">

            <div id="prev-comments">

            <?php if(!empty($comments)) { foreach ($comments as $comment) { 

            if($comment['author_comment'] !== '1') {
            ?>

			<li  class="comment-auction user-comment">

                <div class="info-comments">
                    <a href="#"><?php if(isset($comment['firstname'])) echo $comment['firstname']; ?></a>
                    <span><?php if(isset($comment['ago'])) echo $comment['ago']; ?></span>
                    <input type="hidden" name="comment_id" id="comment_id" value="<?php if(isset($comment['id'])) echo $comment['id']; ?>">
                </div>

                <a class="avatar-comments" href="#">
                    <img src="<?php echo base_url().USER_UPLOAD.$comment['thumbnail']; ?>" width="35" alt="Profile Avatar" title="<?php if(isset($comment['firstname'])) echo $comment['firstname']; ?>" />
                </a>

                <p><?php if(isset($comment['body'])) echo $comment['body']; ?></p>

			</li>

            <?php } else { ?>

			<li class="comment-auction author-comment">

                <div class="info-comments">
                    <a href="#"><?php if(isset($comment['firstname'])) echo $comment['firstname']; ?> (Author)</a> 
                    <span><?php if(isset($comment['ago'])) echo $comment['ago']; ?></span>
                    <input type="hidden" name="comment_id" id="comment_id" value="<?php if(isset($comment['id'])) echo $comment['id']; ?>">
                </div>

                <a class="avatar-comments" href="#">
                    <img src="<?php echo base_url().USER_UPLOAD.$comment['thumbnail']; ?>" width="35" alt="Profile Avatar" title="Jack Smith" />
                </a>

                <p><?php if(isset($comment['body'])) echo $comment['body']; ?></p>

			</li>

            <?php  } } } else { ?>

            <li  class="comment-auction user-comment">

                <div class="info-comments">
                    <a href="#">No Comments were found !</a>
                    <span></span>
                </div>
            </li>
            <?php } ?>

            </div>

            <li class="write-new">

                <form id="commentsForm" class="forms-control" method="post" enctype="multipart/form-data">

                    <textarea placeholder="Write your comment here" name="write_comment" id="write_comment" required="true"></textarea>
                    <input type="hidden" name="logged_user" id="logged_user" value="<?php echo $this->session->userdata('user_id') ?>">
                    <?php if($this->session->userdata('user_id') === $ownerData[0]['user_id']) { ?>
                    <input type="hidden" name="author_comment" id="author_comment" value="1">
                    <?php } else { ?>
                    <input type="hidden" name="author_comment" id="author_comment" value="0">
                    <?php }?>
                    <?php if($comment_section === 'listing') { ?>
                        <input type="hidden" name="comment_listing" id="comment_listing" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id'];  ?>">
                    <?php } else { ?>
                        <input type="hidden" name="comment_listing" id="comment_listing" value="<?php if(isset($blog[0]['id'])) echo $blog[0]['id'];  ?>">
                    <?php } ?>
                    <input type="hidden" name="comment_section" id="comment_section" value="<?php if(isset($comment_section)) echo $comment_section;  ?>">

                    <div>
                        <img src="<?php echo base_url().USER_UPLOAD.$userdata[0]['thumbnail']; ?>" width="35" alt="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>" title="Bradley Jones" />
                        Logged in as <a href="#"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?></a>
                        <div id="commentsVal"></div>
                        <button class="slippa-btn slippa-gradient" type="submit">Submit</button>
                    </div>

                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                </form>

            </li>

		</ul>
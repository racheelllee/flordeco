<?php
/* Cakephp 3.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://cakephp3-user-management.ektanjali.com/
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT. */
?>

<div class="um-panel">
	<div class="um-panel-header">
		
		<span class="um-panel-title">
			<div><h2>INICIAR SESIÓN</h2></div>
		</span>
		<br>
		<?php if(SITE_REGISTRATION) { ?>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Sign Up', true), ['controller'=>'Users', 'action'=>'register', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-primary']); ?>
		</span>
		<?php } ?>
	</div>
	<div class="um-panel-content">
		<?php #echo $this->element('Usermgmt.ajax_validation', ['formId'=>'loginForm', 'submitButtonId'=>'loginSubmitBtn']); ?>
		<?php echo $this->Form->create($userEntity, ['id'=>'loginForm', 'class'=>'m-t']); ?>
		<div class="form-group">
				<?php echo $this->Form->input('Users.email', ['type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Correo Electrónico'), 'class'=>'form-control']); ?>
		</div>
		<div class="form-group">
				<?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Contraseña'), 'class'=>'form-control']); ?>
		</div>
		<?php if(USE_REMEMBER_ME) { ?>
			<div class="form-group">
				<?php if(!isset($userEntity['remember'])) {
						$userEntity['remember'] = true;
					} ?>
					<?php echo $this->Form->input('Users.remember', ['type'=>'checkbox', 'label'=>__('Recordar Sesión')]); ?>
				
			</div>
		<?php } ?>
		<?php if($this->UserAuth->canUseRecaptha('login')) {
			$this->Form->unlockField('recaptcha_challenge_field');
			$this->Form->unlockField('recaptcha_response_field');
			$errors = $userEntity->errors();
			$error = "";
			if(isset($errors['captcha']['_empty'])) {
				$error = $errors['captcha']['_empty'];
			} else if(isset($errors['captcha']['mustMatch'])) {
				$error = $errors['captcha']['mustMatch'];
			}?>
			<div class="um-form-row form-group">
				<label class="col-sm-4 control-label required"><?php echo __('Prove you\'re not a robot');?></label>
				<div class="col-sm-8">
					<?php echo $this->UserAuth->showCaptcha($error);?>
				</div>
			</div>
		<?php } ?>
		<div class="form-group">
			<?php echo $this->Form->Button(__('Iniciar Sesión'), ['div'=>false, 'class'=>'btn btn-primary block full-width m-b', 'id'=>'loginSubmitBtn', 'style'=>'background:#E4680A; border:0;']); ?>
			<br><br>
			<?php echo $this->Html->link(__('Registrarme'), '/register', ['class'=>'block full-width m-b']); ?>
			<br>
			<?php echo $this->Html->link(__('¿Recuperar Contraseña?'), '/forgotPassword', ['class'=>'block full-width m-b']); ?>
			
			<?php //echo $this->Html->link(__('Email Verification'), '/emailVerification', ['class'=>'btn btn-default pull-right um-btn']); ?>
		</div>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->element('Usermgmt.provider'); ?>
	</div>
</div>
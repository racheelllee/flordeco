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
	<!--
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Sign Up');?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Sign In', true), ['controller'=>'Users', 'action'=>'login', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-primary']);?>
		</span>
	</div>
	-->
	<div class="um-panel-content">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6" style="text-align:center; margin-top:40px; margin-bottom:40px;">
				<div style="font-size:23px; color:#1e547f; font-family:'HelveticaNeueLTStd75Bold'; margin-bottom:10px;"><span>REGISTRO</span></div>

				<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'registerForm', 'submitButtonId'=>'registerSubmitBtn']);?>
				<?php echo $this->Form->create($userEntity, ['id'=>'registerForm', 'class'=>'form-horizontal', 'novalidate'=>true]);?>

				<?php echo $this->Form->input('Users.user_group_id', ['type'=>'hidden', 'label'=>false, 'div'=>false, 'class'=>'form-control', 'value' => '4']);?>

				

			
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label required"><?php echo __('Nombre');?></label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('Users.first_name', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']);?>
					</div>
				</div>
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label"><?php echo __('Apellido');?></label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('Users.last_name', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']);?>
					</div>
				</div>
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label required"><?php echo __('Correo Electrónico');?></label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('Users.email', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']);?>
					</div>
				</div>
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label required"><?php echo __('Contraseña');?><br><small>Debe de contener más de 6 caracteres.</small></label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'div'=>false, 'class'=>'form-control']);?>
					</div>
				</div>
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label required"><?php echo __('Confirmar Contraseña');?></label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('Users.cpassword', ['type'=>'password', 'label'=>false, 'div'=>false, 'class'=>'form-control']);?>
					</div>
				</div>
				<div class="um-form-row form-group rgt">
					<label class="col-sm-3 control-label required"><?php echo __('¿Como se entero de nosotros?');?></label>
					<div class="col-sm-6">
						<?php 
            			echo $this->Form->input(
                		'Users.medio_id',
                		array('options' => $medios, 'label' => false)
            			);
						?>
					</div>
				</div>
				<?php if($this->UserAuth->canUseRecaptha('registration')) {
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
						<label class="col-sm-3 control-label required"><?php echo __('Prove you\'re not a robot');?></label>
						<div class="col-sm-6">
							<?php echo $this->UserAuth->showCaptcha($error);?>
						</div>
					</div>
				<?php } ?>
				<div class="um-button-row">
					<?php echo $this->Form->Submit(__('Finalizar Registro'), ['div'=>false, 'class'=>'btn btn-primary', 'id'=>'registerSubmitBtn', 'style'=>'border:0;']);?>
				</div>
				<?php echo $this->Form->end();?>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<?php echo $this->element('Usermgmt.provider'); ?>
			</div>
		</div>
	</div>
</div>
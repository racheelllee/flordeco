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
	<div class="um-panel-content">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4" style="text-align:center; margin-top:40px; margin-bottom:40px;">

					<div class="um-panel-header">
		<span class="um-panel-title">
			<div style="font-size:23px; color:#1e547f; font-family:'HelveticaNeueLTStd75Bold'; margin-bottom:10px;"><span>RESTAURAR CONTRASEÑA</span></div>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Form->create($userEntity, ['class'=>'m-t']); ?>
		<div class="um-form-row form-group">
				<?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'placeholder'=>__('Nueva Contraseña'), 'class'=>'form-control']); ?>
		</div>
		<div class="um-form-row form-group">
				<?php echo $this->Form->input('Users.cpassword', ['type'=>'password', 'label'=>false, 'placeholder'=>__('Confirmar Contraseña'), 'class'=>'form-control']); ?>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit(__('Guardar nueva Contraseña'), ['div'=>false, 'class'=>'btn btn-primary block full-width m-b', 'style'=>'background:#E4680A; border:0;']); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
			</div>
		</div>
	</div>
</div>

<!--

<div >
	<div class="um-panel-header">
		<span class="um-panel-title">
			<h3><?php echo __('Reset Password'); ?></h3>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Form->create($userEntity, ['class'=>'m-t']); ?>
		<div class="um-form-row form-group">
				<?php echo $this->Form->input('Users.password', ['type'=>'password', 'label'=>false, 'placeholder'=>__('New Password'), 'class'=>'form-control']); ?>
		</div>
		<div class="um-form-row form-group">
				<?php echo $this->Form->input('Users.cpassword', ['type'=>'password', 'label'=>false, 'placeholder'=>__('Confirm Password'), 'class'=>'form-control']); ?>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit(__('Save New Password'), ['div'=>false, 'class'=>'btn btn-primary block full-width m-b']); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

-->
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
<?php
if(!isset($paginationText)) {
	$paginationText =__('Total Registros');
} ?>
<div style="text-align:right">
	<ul class="pagination">
<?php	echo "<li><span>".$this->Paginator->counter(['format'=>$paginationText.' {{count}}'])."</span></li>";
		$firstP = $this->Paginator->first(__('<<'), ['tag'=>'li']);
		if(!empty($firstP)) {
			echo $firstP;
		} else {
			echo "<li class='disabled'><span>".__('<<')."</span></li>";
		}
		if($this->Paginator->hasPrev()) {
			echo $this->Paginator->prev(__('<'), ['tag'=>'li']);
		} else {
			echo "<li class='disabled'><span>".__('<')."</span></li>";
		}
		echo $this->Paginator->numbers(['separator'=>'', 'tag'=>'li', 'currentTag'=>'span']);
		if($this->Paginator->hasNext()) {
			echo $this->Paginator->next(__('>'), ['tag'=>'li']);
		} else {
			echo "<li class='disabled'><span>".__('>')."</span></li>";
		}
		$lastP = $this->Paginator->last(__('>>'), ['tag'=>'li']);
		if(!empty($lastP)) {
			echo $lastP;
		} else {
			echo "<li class='disabled'><span>".__('>>')."</span></li>";
		}
		echo "<li><span>".$this->Paginator->counter(['format'=>__('Página').' {{page}} '.__('de').' {{pages}}'])."</span></li>";
		echo "<li><span style='padding: 5px 2px 0;height:28px;width:26px'>".$this->Html->image(SITE_URL.'usermgmt/img/loading-circle.gif', ['class'=>'busy-indicator', 'style'=>'display:none;'])."</span></li>"; ?>
	</ul>
</div>
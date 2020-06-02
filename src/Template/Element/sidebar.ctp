        <ul class="nav justify-content-center">
            <li class="nav-item">
                <?= $this->Html->link('Main','/',['class'=> 'nav-link']); ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('自己診断',['controller' => 'Diagnosis', 'action' => 'add'],['class'=> 'nav-link']); ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('診断表の確認',['controller' => 'Diagnosis', 'action' => 'index'],['class'=> 'nav-link']); ?>
            </li>
            <!-- for logged-in user -->
            <?php if ($this->request->getSession()->read('Auth')): ?>
            <!--https://stackoverflow.com/questions/27573134/cakephp-3-x-authcomponentuser-in-view -->
            <li class="nav-item">
                <?= $this->Html->link('Logout','/user/logout',['class'=> 'nav-link']); ?>
            </li>
            <!-- for Unlogged User -->
            <?php else: ?>
            <li class="nav-item">
                <?= $this->Html->link('Login','/user/login',['class'=> 'nav-link']); ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Sign up!','/user/sign_up',['class'=> 'nav-link']); ?>
            </li>
            <?php endif; ?>
        </ul>

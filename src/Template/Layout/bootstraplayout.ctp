<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->element('head') ?>
</head>
<body>
    <?= $this->element('header') ?>
    <!-- Page Content -->
    <div class="container">
        <?= $this->Flash->render() ?>
        
            <?= $this->fetch('content') ?>
      
    </div>
    <?= $this->element('footer') ?>
</body>
</html>
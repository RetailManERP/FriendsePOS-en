<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Redirecting to <?php echo e($gateway_name, false); ?>...</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }
        .redirect-card {
            text-align: center;
            padding: 3rem;
            background: rgba(255,255,255,0.05);
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
        }
        .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255,255,255,0.2);
            border-top: 4px solid #06b6d4;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        h2 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        p { color: #94a3b8; font-size: 0.95rem; }
    </style>
</head>
<body>
    <div class="redirect-card">
        <div class="spinner"></div>
        <h2>Redirecting to <?php echo e($gateway_name, false); ?></h2>
        <p>Please wait while we connect you to the payment gateway...</p>
        <p style="font-size:0.8rem; margin-top:1rem;">If you are not redirected automatically, <a href="#" onclick="document.getElementById('gateway-form').submit(); return false;" style="color:#06b6d4;">click here</a>.</p>
    </div>

    <form id="gateway-form" method="POST" action="<?php echo e($gateway_url, false); ?>" style="display:none;">
        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="<?php echo e($key, false); ?>" value="<?php echo e($value, false); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('gateway-form').submit();
            }, 1500);
        });
    </script>
</body>
</html>

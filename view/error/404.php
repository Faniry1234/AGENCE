<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - 404</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .error-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 3rem 2rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        
        .error-code {
            font-size: 4rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .error-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .error-message {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .action-links {
            display: flex;
            gap: 1rem;
            flex-direction: column;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        
        .btn-secondary:hover {
            background: #d0d0d0;
            transform: translateY(-2px);
        }
        
        @media (max-width: 600px) {
            .error-container {
                padding: 2rem 1rem;
            }
            
            .error-code {
                font-size: 3rem;
            }
            
            .error-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">🔍</div>
        <div class="error-code">404</div>
        <h1 class="error-title">Page non trouvée</h1>
        <p class="error-message">
            La page que vous recherchez n'existe pas ou a été déplacée.
        </p>
        <div class="action-links">
            <a href="index.php" class="btn btn-primary">Retourner à l'accueil</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</body>
</html>

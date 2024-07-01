pipeline {
    agent {
        docker {
            image 'php:8.3'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }
    environment {
        COMPOSER_HOME = "$WORKSPACE/.composer"
        PATH = "$COMPOSER_HOME/vendor/bin:$PATH"
    }
    stages {
        stage('Clone Repository') {
            steps {
                git 'https://github.com/ritshidze/personalized-video-campaign-manager.git'
            }
        }
        stage('Install Composer') {
            steps {
                sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=$COMPOSER_HOME --filename=composer'
            }
        }
        // stage('Run Tests') {
        //     steps {
        //         sh 'php artisan test'
        //     }
        // }
        stage('Build Docker Image') {
            steps {
                sh 'docker compose build'
            }
        }
        stage('Deploy') {
            steps {
                sh 'docker compose up -d'
            }
        }
    }

    post {
        always {
            // Clean up workspace
            cleanWs()
        }
        success {
            // Notify success
            echo 'Pipeline succeeded!'
        }
        failure {
            // Notify failure
            echo 'Pipeline failed!'
        }
    }
}

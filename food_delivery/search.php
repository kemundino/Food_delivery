<?php
require_once 'includes/header.php';

// Get search parameters
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Mock search results (in a real app, this would query the database)
$searchResults = [];

if (!empty($location)) {
    // Mock restaurants based on location
    $searchResults = [
        [
            'id' => 1,
            'name' => 'Pizza Palace',
            'cuisine' => 'Italian, Pizza',
            'delivery_time' => '30-45 min',
            'min_order' => '$15.00',
            'rating' => 4.5,
            'review_count' => 128,
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_open' => true,
            'address' => '123 Main St, ' . htmlspecialchars($location)
        ],
        [
            'id' => 2,
            'name' => 'Burger Barn',
            'cuisine' => 'American, Burgers',
            'delivery_time' => '20-35 min',
            'min_order' => '$10.00',
            'rating' => 4.2,
            'review_count' => 95,
            'image' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_open' => true,
            'address' => '456 Oak Ave, ' . htmlspecialchars($location)
        ],
        [
            'id' => 3,
            'name' => 'Sushi Express',
            'cuisine' => 'Japanese, Sushi',
            'delivery_time' => '25-40 min',
            'min_order' => '$20.00',
            'rating' => 4.7,
            'review_count' => 156,
            'image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_open' => true,
            'address' => '789 Elm St, ' . htmlspecialchars($location)
        ]
    ];
}
?>

<div class="container" style="margin-top: 100px;">
    <div class="search-header">
        <h1>Search Results</h1>
        <?php if (!empty($location)): ?>
            <p>Restaurants delivering to: <strong><?php echo htmlspecialchars($location); ?></strong></p>
        <?php elseif (!empty($query)): ?>
            <p>Search results for: <strong><?php echo htmlspecialchars($query); ?></strong></p>
        <?php else: ?>
            <p>Please enter a location or search term</p>
        <?php endif; ?>
    </div>

    <?php if (empty($location) && empty($query)): ?>
        <div class="search-prompt">
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-search" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h3>Find Restaurants Near You</h3>
                <p>Enter your delivery address to see restaurants that deliver to your area</p>
                <div class="search-container" style="max-width: 500px; margin: 2rem auto;">
                    <form action="search.php" method="GET" class="search-form">
                        <div class="search-input-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="location" placeholder="Enter your delivery address" required>
                            <button type="submit" class="btn btn-primary">Find Food</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif (empty($searchResults)): ?>
        <div class="no-results">
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-search" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                <h3>No restaurants found</h3>
                <p>Try adjusting your search or entering a different location</p>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    <?php else: ?>
        <div class="results-info">
            <p>Found <?php echo count($searchResults); ?> restaurants</p>
        </div>

        <div class="restaurants-grid">
            <?php foreach ($searchResults as $restaurant): ?>
                <div class="restaurant-card fade-in" data-id="<?php echo $restaurant['id']; ?>" 
                     data-name="<?php echo htmlspecialchars($restaurant['name']); ?>"
                     data-image="<?php echo $restaurant['image']; ?>">
                    <div class="card-img-container">
                        <img src="<?php echo $restaurant['image']; ?>" alt="<?php echo htmlspecialchars($restaurant['name']); ?>" class="card-img">
                        <?php if ($restaurant['is_open']): ?>
                            <span class="badge open">Open Now</span>
                        <?php else: ?>
                            <span class="badge closed">Closed</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($restaurant['name']); ?></h3>
                        <p class="cuisine"><?php echo htmlspecialchars($restaurant['cuisine']); ?></p>
                        <p class="restaurant"><?php echo htmlspecialchars($restaurant['address']); ?></p>
                        <div class="restaurant-meta">
                            <span class="rating">
                                <i class="fas fa-star"></i> <?php echo $restaurant['rating']; ?>
                                (<?php echo $restaurant['review_count']; ?>)
                            </span>
                            <span class="delivery-time"><?php echo $restaurant['delivery_time']; ?></span>
                        </div>
                        <div class="restaurant-meta">
                            <span class="min-order">Min order: <?php echo $restaurant['min_order']; ?></span>
                            <a href="pages/restaurant.php?id=<?php echo $restaurant['id']; ?>" class="btn btn-primary btn-sm">View Menu</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.search-header {
    margin-bottom: 2rem;
}

.search-header h1 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.search-header p {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.search-prompt,
.no-results {
    margin-top: 2rem;
}

.results-info {
    margin-bottom: 1.5rem;
    color: var(--text-secondary);
}

.restaurant-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: var(--transition);
}

.restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.card-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.restaurant-card:hover .card-img {
    transform: scale(1.05);
}

.badge {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-sm);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius);
    font-size: 0.75rem;
    font-weight: 600;
}

.badge.open {
    background: var(--success-color);
    color: white;
}

.badge.closed {
    background: var(--danger-color);
    color: white;
}

.card-content {
    padding: var(--spacing-md);
}

.card-content h3 {
    margin-bottom: var(--spacing-xs);
    font-size: 1.125rem;
    color: var(--text-primary);
}

.cuisine,
.restaurant {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: var(--spacing-sm);
}

.restaurant-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-md);
    font-size: 0.875rem;
}

.rating {
    color: var(--warning-color);
    font-weight: 600;
}

.delivery-time,
.min-order {
    color: var(--text-secondary);
}
</style>

<?php require_once 'includes/footer.php'; ?>
